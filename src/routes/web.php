<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;


// 商品一覧画面(トップ画面)
Route::get('/', [ItemController::class, 'index']);
Route::get('/mylist', [ItemController::class, 'mylist']);
Route::get('search',[ItemController::class,'search']);

// 会員登録画面
Route::post('/register', [UserManagementController::class, 'register']);

// ログイン
Route::post('/login', [UserManagementController::class, 'login']);

// 商品詳細画面
Route::get('/item/{item_id}', [ItemController::class, 'item']);
Route::post('/item/{item_id}/good',[ItemController::class,'good'])->middleware('auth');
Route::post('/item/{item_id}/comment',[ItemController::class,'comment'])->middleware('auth');

// 商品購入画面
Route::get('/purchase/{item_id}', [ItemController::class, 'showPurchase']);
Route::post('/purchase/{item_id}/buy', [ItemController::class, 'purchase']);

// 住所変更ページ
Route::get('/purchase/address/{item_id}', [ItemController::class, 'showAddress']);
Route::post('/purchase/address/{item_id}/change', [ItemController::class, 'address']);

// 商品出品画面
Route::get('/sell', [ItemController::class, 'showSell']);
Route::post('/sell/done', [ItemController::class, 'sell']);

// プロフィール画面
Route::get('/mypage',[UserController::class,'mypage']);

// プロフィール編集画面
Route::middleware(['auth'])->group(function(){
    Route::get('/mypage/profile', [UserController::class, 'showProfile']);
    Route::post('/mypage/profile/done', [UserController::class, 'profile'])->name('profile.update');
});
