<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class UserManagementController extends Controller
{
    //　会員登録機能
    public function register(RegisterRequest $request)
    {
        // バリデーション（入力チェック）
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ユーザーを作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // メールで認証とかに使う記述らしい。実装時詳細確認予定。
        event(new Registered($user));

        // ログインする。
        Auth::login($user);

        // 登録後のみプロフィールへ
        return redirect('/mypage/profile'); 

    }

    // ログイン機能
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'ログイン情報が登録されていません',
        ]);
    }
}
