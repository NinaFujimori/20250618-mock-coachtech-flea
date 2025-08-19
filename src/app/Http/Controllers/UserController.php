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
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileWithAddressRequest;

class UserController extends Controller
{
    //プロフィール画面
    public function mypage(){

        return view('mypage');
    }
 
    //プロフィール編集画面
    public function showProfile(){
        $user = Auth::user();

        //profilesテーブルからuser_idを使ってカラムを探し、なければ新しく作る処理
        $profile = Profile::firstOrNew(['user_id' => $user->id]);

        // 「初回かどうか」を zip_code が未入力かで判定
        $isFirstTime = empty($profile->zip_code);

        return view('mypageProfile',compact('user','profile','isFirstTime'));
    }

    public function profile(ProfileWithAddressRequest $request)
    {
        $user = Auth::user();

        // プロフィールを取得してなければ新しく作成
        $profile = Profile::firstOrNew(['user_id' => $user->id]);

        // 初回かどうか（zip_code で判定）
        $isFirstTime = empty($profile->zip_code);

        // 画像がアップロードされていれば保存
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('image', 'public');
            $profile->image = $filename;
        } else {
            $filename = null;
        }

        // 値の更新
        $profile->image = $filename ?? $profile->image;
        $profile->zip_code = $request->zip_code;
        $profile->address = $request->address;
        $profile->building = $request->building;
        $profile->save();

        $user->name = $request->name;
        $user->save();

        if ($isFirstTime) {
            // 初回の場合はトップページへ遷移
            $items = Item::where('user_id', '!=', Auth::id())->get();
            $purchasedItemIds = PurchasedItem::pluck('item_id')->toArray();
            return view('top', compact('items','purchasedItemIds'));
        } else {
            // 2回目以降はマイページへ遷移
            return redirect('/mypage');
        }
    }
}
