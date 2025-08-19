@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection

@section('content')

<div class="register">

    <div class="register__inner">

        <h1>会員登録</h1>

        <form action="/register" method="post" class="register__form">
            @csrf

            <div class="register__form-input">
                <p>ユーザー名</p>
                <input type="text" name="name" value="{{ old('name') }}" />
                <div class="register__form-error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register__form-input">
                <p>メールアドレス</p>
                <input type="text" name="email" value="{{ old('email') }}" />
                <div class="register__form-error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register__form-input">
                <p>パスワード</p>
                <input type="password" name="password" />
                <div class="register__form-error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register__form-input">
                <p>確認用パスワード</p>
                <input type="password" name="password_confirmation" />
                <div class="register__form-error">
                    @error('password_confirmation')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            
            <button type="submit" class="register__button-profile">登録する</button><br>
            <a href="/login" class="register__button-login">ログインはこちら</a>
        </form>
    </div>

</div>

@endsection