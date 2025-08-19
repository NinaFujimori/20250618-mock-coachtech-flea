<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Mylist;
use App\Models\PurchasedItem;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{

    // 商品一覧画面（トップ画面）
    public function index()
    {
        if (Auth::check()) {
            // ログイン中のユーザーIDを除外
            $items = Item::where('user_id', '!=', Auth::id())->get();
        } else {
            // 未ログイン時は全商品を表示
            $items = Item::all();
        }
        $purchasedItemIds = PurchasedItem::pluck('item_id')->toArray(); // 購入済み商品のID配列

        return view('top', compact('items','purchasedItemIds'));
    }
    public function mylist(Request $request){
        $tab = $request->input('tab');

        if ($tab === 'mylist' && Auth::check()) {
            // ログイン中のユーザーがいいねした商品を取得
            $mylistItemIds = Mylist::where('user_id', Auth::id())->pluck('item_id');
            $items = Item::whereIn('id', $mylistItemIds)->get();
        } else {
            // 自分が出品した商品を除いてすべて表示（おすすめ）
            if (Auth::check()) {
                $items = Item::where('user_id', '!=', Auth::id())->get();
            } else {
                $items = Item::all();
            }
        }
        $purchasedItemIds = PurchasedItem::pluck('item_id')->toArray(); // 購入済み商品のID配列

        return view('top', compact('items','purchasedItemIds'));
    }
    public function search(Request $request){
        $keyword = $request->input('keyword');
        $target = $request->input('search_target'); // 'recommend' or 'mylist'
        $items = collect(); // 空のコレクションを用意
        $purchasedItemIds = PurchasedItem::pluck('item_id')->toArray();

        if ($target === 'mylist' && Auth::check()) {
            // マイリスト内検索
            $mylistItemIds = Mylist::where('user_id', Auth::id())->pluck('item_id');

            $items = Item::whereIn('id', $mylistItemIds)
                ->where('name', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            // おすすめ内検索（自分の出品商品を除外）
            if (Auth::check()) {
                $items = Item::where('user_id', '!=', Auth::id())
                    ->where('name', 'like', '%' . $keyword . '%')
                    ->get();
            } else {
                $items = Item::where('name', 'like', '%' . $keyword . '%')->get();
            }
        }

        return view('top', compact('items', 'purchasedItemIds'));
    }

    // 商品詳細画面
    public function item($item_id){
        $item = Item::with('categories')->find($item_id);
        $categories = $item->categories;
        $user = Auth::user();

        // ログインユーザーがこの商品をマイリスト登録しているか
        $mylist = $user ? 
                        Mylist::where('item_id', $item_id)
                        ->where('user_id', $user->id)
                        ->exists()
                    :false;

        $myComment = $user ? 
                        Comment::where('item_id', $item_id)
                        ->where('user_id', $user->id)
                        ->exists()
                    :false;
        
        // この商品の登録数
        $mylistCount = Mylist::where('item_id', $item_id)->count();
        $commentCount = Comment::where('item_id', $item_id)->count();

        $comments = Comment::where('item_id', $item_id)
        ->with(['user.profile'])
        ->get();

        return view('item', compact('item','categories', 'mylist','mylistCount','myComment','commentCount', 'comments','user'));
    }

    public function good($item_id){
        $user = Auth::user();

        // 既に登録されているか確認
        $existing = Mylist::where('user_id', $user->id)
                      ->where('item_id', $item_id)
                      ->first();

        if ($existing) {
            // すでにある場合は削除
            $existing->delete();
        } else {
            // ない場合は新規作成
            Mylist::create([
                'user_id' => $user->id,
                'item_id' => $item_id,
            ]);
        }

        return redirect()->back();

    }

    public function comment(CommentRequest $request, $item_id){
        $item = Item::find($item_id);
        $user = Auth::user();

        $comment = Comment::create([
            'user_id'    => $user->id,
            'item_id'    => $item->id,
            'comment'    => $request->comment,
        ]);

        return redirect()->back();
    }

    // 商品購入画面
    public function showPurchase($item_id){
        $item = Item::find($item_id);
        $user = Auth::user();

        //ログインしてなければログイン画面へ
        if (!$user) {
            return redirect('/login');
        }
        
        // プロフィールから初期値を取得
        $profile = Profile::where('user_id', $user->id)->first();

        $default_address = [
            'zip_code' => optional($profile)->zip_code,
            'address' => optional($profile)->address,
            'building' => optional($profile)->building,
        ];

        // セッションに住所入力があればそれを優先
        $session_address = session('address_other');

        //$session_addressに値があればそれをなければ$default_addressを使う。
        $purchase = $session_address ?? $default_address;

        return view('purchase',compact('item','purchase','user'));
    }

    //商品購入機能
    public function purchase(Request $request, $item_id){
        $item = Item::find($item_id);
        $user = Auth::user();

        PurchasedItem::create([
            'user_id' => $user->id,
            'item_id' => $item_id,
            'zip_code'=> $request->zip_code,
            'address' => $request->address,
            'building'=> $request->building,
        ]);

        $items = Item::where('user_id', '!=', Auth::id())->get();
        $purchasedItemIds = PurchasedItem::pluck('item_id')->toArray();
        return view('top', compact('items','purchasedItemIds'));

    }

    // 住所変更ページ
    public function showAddress($item_id){
        $item = Item::find($item_id);
        return view('address', compact('item'));
    }
    public function address(AddressRequest $request, $item_id){
        $session_address = $request->only(['zip_code','address','building']);
    
        return redirect()->route('purchase.show', ['item_id' => $item_id])
            ->with('address_other', $session_address);
    }

    // 商品出品画面
    public function showSell(){
        $categories = Category::all();
        return view('sell',compact('categories'));
    }

    public function sell(ItemRequest $request){
        $user = Auth::user();

        // 画像がアップロードされていれば保存
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('image', 'public');
        } else {
            $filename = null;
        }

        $item = Item::create([
            'user_id'    => $user->id,
            'image'      => $filename,
            'condition'  => $request->condition,
            'name'       => $request->name,
            'brand'      => $request->brand,
            'description'=> $request->description,
            'price'      => $request->price,
        ]);

        // カテゴリー（複数）を保存
        $categories = $request->input('category'); // checkboxのname="category[]" より
        if ($categories) {
            foreach ($categories as $category_id) {
                ItemCategory::create([
                    'item_id'     => $item->id,
                    'category_id' => $category_id,
                ]);
            }
        }

        $items = Item::where('user_id', '!=', Auth::id())->get();
        $purchasedItemIds = PurchasedItem::pluck('item_id')->toArray();
        return view('top', compact('items','purchasedItemIds'));
    }
}
