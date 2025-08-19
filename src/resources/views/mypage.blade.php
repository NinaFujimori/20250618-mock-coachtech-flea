@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
@endsection

@section('content')

<h1>プロフィール画面</h1>
<a href="/mypage/profile">プロフィールを編集</a>
@endsection