@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css')}}">
@endsection

@section('content')

<div class="item">
    <div class="item__image">
        <img src="{{ asset( 'storage/' . $item->image ) }}" alt="商品画像">
    </div>
    <div class="item__detail">
        <div class="item__name">
            <h1>{{$item -> name}}</h1>
            <p>{{$item -> brand}}</p>
        </div>

        <div class="item__price">
            <h2><span>￥</span>{{$item -> price}}<span>(税込)</span></h2>
        </div>

        <table class="item__mylists">
            <tr>
                <th>
                    @if(Auth::check())
                    <form action="/item/{{ $item->id }}/good" method="POST">
                        @csrf
                        @if($mylist)
                        <button type="submit" style="border:none; background:none; padding:0;">
                            <img src="{{ asset('storage/image/mylistDone.png') }}" alt="いいね済" class="item__mylists-image">
                        </button>
                        @else
                        <button type="submit" style="border:none; background:none; padding:0;">
                            <img src="{{ asset('storage/image/mylistEmpty.png') }}" alt="いいね未" class="item__mylists-image">
                        </button>
                        @endif
                    </form>
                    @else
                    <label for="">
                        <a href="{{ route('login') }}">
                        <img src="{{ asset('storage/image/mylistEmpty.png') }}" alt="いいね未" class="item__mylists-image">
                    </label>
                    @endif
                </th>
                <th>
                    @if($myComment)
                    <img src="{{ asset('storage/image/commentDone.png') }}" alt="コメント済" class="item__mylists-image">
                    @else
                    <img src="{{ asset('storage/image/commentEmpty.png') }}" alt="コメント未" class="item__mylists-image">
                    @endif
                </th>
            </tr>
            <tr class="item__mylists-count">
                <td>{{ $mylistCount }}</td>
                <td>{{ $commentCount }}</td>
            </tr>
        </table>

        <div class="item__buy">
            <a href="{{ url('/purchase/' . $item->id) }}">購入手続きへ</a>
        </div>
    
        <div class="item__description">
            <h2 class="item__title">商品説明</h2>
            <p>{{$item -> description}}</p>
        </div>

        <div class="item__description">
            <h2 class="item__title">商品の情報</h2>
            <div>
                <h3 class="item__title-info">カテゴリー</h3>
                @forelse( $categories as $category)
                    <p class="item__category">{{ $category->category }}</p>
                @empty
                    <p>カテゴリーは設定されていません。</p>
                @endforelse
            </div>

            <div>
                <h3 class="item__title-info">商品の状態</h3>
                @switch($item -> condition)
                    @case(0)
                        <p>良好</p>
                        @break
                    @case(1)
                        <p>目立った傷や汚れなし</p>
                        @break
                    @case(2)
                        <p>やや傷や汚れあり</p>
                        @break
                    @case(3)
                        <p>状態が悪い</p>
                        @break
                    @default
                        <p>不明</p>
                @endswitch
            </div>
        </div>

        <div>
            <div class="item__title-comment">
                <h2>コメント<span>({{ $commentCount }})</span></h2>
            </div>

            <div>
                @foreach($comments as $comment)
                    <div class="item__comment">
                        <img src="{{ asset('storage/' . $comment ->user ->profile -> image) }}" alt="" >
                        <p>{{$comment -> user -> name}}</p>
                        <p>{{$comment -> comment}}</p>
                    </div>
                @endforeach
            </div>

            <div> 
                <h2>商品へのコメント</h2>

                @if(Auth::check())
                <form method="POST" action="/item/{{ $item->id }}/comment">
                    @csrf
                    <input type="hidden" name="user_id" value="user_id">
                    <input type="hidden" name="item_id" value="item_id">
                    <input type="textbox" name="comment">
                    <input type="submit" value="コメントを送信する">
                </form>
                @else
                <label for="">
                    <a href="{{ route('login') }}">
                        <input type="textbox" name="comment">
                        <input type="submit" value="コメントを送信する">
                </label>
                @endif
                <div>
                    @error('comment')
                    {{ $message }}
                    @enderror
                </div>
            </div>

        </div>

    </div>
</div>

@endsection