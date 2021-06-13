@extends('layouts.layouts')
   
@section('title', 'メインぺージ')

<h1>メインページ</h1>
<form action="mypage/{{ $username }}" method="post">
    <a href="mypage/{{ $username }}">Myページ</a>
    <input type="hidden">
</form>

<form action="logout" method="post">
    <a href="logout">ログアウト</a>
    <input type="hidden">
</form>

