@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css')}}">
@endsection

@section('content')

<div>

    <h1>住所の変更</h1>
    <div>
        <form action="/purchase/address/{{ $item->id }}/change" method="post">
            @csrf
            <p>郵便番号</p>
            <input type="text"  name="zip_code" value="{{ $purchase['zip_code']?? ''}}" >
            <div>
                @error('zip_code')
                {{ $message }}
                @enderror
            </div>
            <p>住所</p>
            <input type="text" name="address" value="{{ $purchase['address']?? ''}}">
            <div>
                @error('address')
                {{ $message }}
                @enderror
            </div>
            <p>建物名</p>
            <input type="text" name="building" value="{{ $purchase['building']?? ''}}">

            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <button>更新する</button>
        </form>
    </div>

</div>
