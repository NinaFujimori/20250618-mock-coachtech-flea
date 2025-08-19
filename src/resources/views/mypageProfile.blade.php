@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypageProfile.css')}}">
@endsection


@section('content')

<div class="profile">

    <h1>プロフィール設定</h1>
    <div class="profile__inner">
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="profile__form">
            @csrf

            <div>
                @if($profile->image)
                    <img src="{{ asset('storage/' . $profile->image) }}" alt="あなたの画像">
                @else
                    <p>画像はまだ登録されていません</p>
                @endif
                <label for="profile_image" class="profile__form--choice">画像を選択する</label>
                <input type="file" id="profile_image"  name="image" style="display: none;">
                @error('image')
                    <span>
                        <p>{{$errors->first('image')}}</p>
                    </span>
                @enderror
                @error('image.*')
                    <span><p>{{ $message }}</p></span>
                @enderror
            </div>

            <div>
                <p>ユーザー名</p>
                <input type="text" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <span>
                        <p>{{$errors->first('name')}}</p>
                    </span>
                @enderror
            </div>
            <div>
                <p>郵便番号</p>
                <input type="text" name="zip_code" value="{{ old('zip_code', $profile->zip_code) }}">
                @error('zip_code')
                    <span>
                        <p>{{$errors->first('zip_code')}}</p>
                    </span>
                @enderror
            </div>
            <div>
                <p>住所</p>
                <input type="text" name="address" value="{{ old('address', $profile->address) }}">
                @error('address')
                    <span>
                        <p>{{$errors->first('address')}}</p>
                    </span>
                @enderror
            </div>
            <div>
                <p>建物名</p>
                <input type="text" name="building" value="{{ old('building', $profile->building) }}">
            </div>
            
            <br>
            <button type="submit" class="profile__form--update">更新する</button>
        </form>
    </div>

</div>
