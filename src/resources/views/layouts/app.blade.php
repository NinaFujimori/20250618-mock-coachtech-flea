<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>
<body>
    <div class="app">

        <header class="header">
            <div class="headr__inner">
                <div class="header__image">
                    <img src="storage/image/logo.svg" alt="COACHTECH">
                </div>
                @if (!request()->is('register') && !request()->is('login'))
                    <form action="/search" method="GET" class="header__search">
                        <input type="text" placeholder="何をお探しですか？" name="keyword" value="{{request('keyword')}}">
                        <input type="hidden" name="search_target" value="{{ request('tab', 'recommend') }}">
                    </form>
                    <div class="header__button">
                        <div>
                            @if(Auth::check())
                                <form action="/logout" method="post">
                                @csrf
                                <button>ログアウト</button>
                                </form>
                            @else
                                <a href="/login">ログイン</a>
                            @endif
                        </div>
                        <div>
                            @if(Auth::check())
                                <a href="/mypage">マイページ</a>
                            @else
                                <a href="/login">マイページ</a>
                            @endif
                        </div>
                        <div class="header__button-sell">
                            @if(Auth::check())
                                <a href="/sell">出品</a>
                            @else
                                <a href="/login">出品</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            
        </header>

        <div class="content">
            @yield('content')
        </div>

    </div>
    
</body>
</html>