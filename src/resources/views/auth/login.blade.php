@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css')}}">
@endsection

@section('content')

<div class="login">

    
    <div class="login__inner">

        <h1>ログイン</h1>

        <form action="/login" method="post" class="login__form">
            @csrf

            <div class="login__form-input">
                <p>メールアドレス</p>
                <input type="text" name="email" value="{{ old('email') }}" />
                <div class="login__form-error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="login__form-input">
                <p>パスワード</p>
                <input type="password" name="password" />
                <div class="login__form-error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <button type="submit" class="login__button-top">ログインする</button><br>
            <a href="/register" class="login__button-register">会員登録はこちら</a>

        </form>

    </div>

</div>

@endsection