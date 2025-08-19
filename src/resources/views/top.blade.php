@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/top.css')}}">
@endsection


@section('content')

<div class ="top">

    <form action="/mylist" method="get" class="top__button">
        <button name="tab" value="recommend">おすすめ</button>
        <button name="tab" value="mylist">マイリスト</button>
    </form>
    <div class="top__back">
        <div class="top__items">
            @foreach($items as $item)
                <label for="" class="top__items--card">
                    <a href="/item/{{ $item->id }}" class="top__items--link">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
                        @if(in_array($item->id, $purchasedItemIds))
                            <div class="top__items--overlay"></div>
                            <span class="top__items--sold">SOLD</span>
                        @endif
                        <p>{{$item -> name}}</p>
                    </a>
                </label>
            @endforeach
        </div>
    </div>
    

</div>