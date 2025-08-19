@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
@endsection


@section('content')

<div>
    <div>
        <div>
            <img src="{{ asset( 'storage/' . $item->image ) }}" alt="商品画像">
            <h1>{{ $item -> name }}</h1>
            <p><span>￥</span>{{ $item -> price }}</p>
        </div>
        <div>
            <p>支払方法</p>
            <form action="">
                <select name="" id="">
                    <option disabled selected>選択してください</option>
                    <option value="1">コンビニ払い</option>
                    <option value="2">カード支払い</option>
                </select>
            </form>
        </div>
        <div>
            <div>
                <p>配送先</p>
                <a href="{{ url('/purchase/address/' . $item->id) }}">変更する</a>
            </div>
            <div>
                <p><span>〒</span>{{ $purchase['zip_code'] }}</p>
                <p>{{ $purchase['address'] }}{{ $purchase['building'] }}</p>
            </div>
        </div>
        <div>
            <table>
                <tr>
                    <th>商品代金</th>
                    <tr><span>￥</span>{{ $item -> price }}</tr>
                </tr>
                <tr>
                    <th>支払い方法</th>
                    <tr></tr>
                </tr>
            </table>
        </div>
        <div>
            <form action="{{ url('/purchase/' . $item->id . '/buy') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="user_id">
                <input type="hidden" name="item_id" value="item_id">
                <input type="hidden" name="zip_code" value="{{$purchase['zip_code']}}">
                <input type="hidden" name="address" value="{{$purchase['address']}}">
                <input type="hidden" name="building" value="{{$purchase['building']}}">
                <label for="purchase_button">購入する</label>
                <input type="submit" id="purchase_button" style="display: none;">
            </form>
            
        </div>
    </div>
    <div>

    </div>
</div>


@endsection