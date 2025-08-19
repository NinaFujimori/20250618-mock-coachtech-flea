@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css')}}">
@endsection


@section('content')

<div>
    <h1>商品の出品</h1>
    <div>
        <form action="/sell/done" method="post" enctype="multipart/form-data">
            @csrf

            <div>
                <p>商品画像</p>
                <div>
                    <label for="image" class="profile__form--choice">画像を選択する</label>
                    <input type="file" id="image"  name="image" style="display: none;">
                </div>
                <div>
                    @error('image')
                    <span>
                        <p>{{$errors->first('image')}}</p>
                    </span>
                    @enderror
                    @error('image.*')
                    <span><p>{{ $message }}</p></span>
                    @enderror
                </div>
            </div>

            <div>
                <div>
                    <h2>商品の詳細</h2>
                </div>

                <div>
                    <p>カテゴリー</p>
                    @foreach($categories as $category)
                    <label>
                        <input type="checkbox" name="category[]" value="{{ $category->id }}">
                        {{ $category->category }}
                    </label>
                    @endforeach
                    <div>
                        @error('category')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <p>商品の状態</p>
                    <select name="condition">
                        <option value="">選択してください</option>
                        <option value="0">良好</option>
                        <option value="1">目立った傷や汚れ無し</option>
                        <option value="2">やや傷や汚れあり</option>
                        <option value="3">状態が悪い</option>
                    </select>
                    <div>
                        @error('condition')
                        <p>{{$errors->first('condition')}}</p>
                        @enderror
                    </div>
                </div>

            </div>

            <div>
                <div>
                    <h2>商品名と説明</h2>
                </div>

                <div>
                    <p>商品名</p>
                    <input type="text" name="name">
                    <div>
                        @error('name')
                        <p>{{$errors->first('name')}}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <p>ブランド名</p>
                    <input type="text" name="brand">
                </div>

                <div>
                    <p>商品の説明</p>
                    <textarea name="description"></textarea>
                    <div>
                        @error('description')
                        <p>{{$errors->first('description')}}</p>
                        @enderror
                    </div>
                </div>

                <div class="price-input">
                    <p>販売価格</p>
                    <div class="input-wrapper">
                        <span class="yen">￥</span>
                        <input type="text" name="price"/>
                    </div>
                    <div>
                        @error('price')
                        <p>{{$errors->first('price')}}</p>
                        @enderror
                    </div>
                </div>
                
            </div>

            <div>
                <button type="submit">出品する</button>
            </div>
        </form>

    </div>
    
</div>
@endsection