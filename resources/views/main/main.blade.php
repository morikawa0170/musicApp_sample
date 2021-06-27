<!--@extends('layouts.layouts')-->
   
<!--@section('title', 'メインぺージ')-->

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            .table td{
                vertical-align: middle;
                height: 100px;
            }
        </style>
    </head>
    <body>
        <h1>メインページ</h1>
        <a href="mypage/{{ $name }}">Myページ</a>
        <a href="logout">ログアウト</a>
        <div id="list" class="container">
            <table class="table">
                <thead class="thead-light">
                    <tr><th>タイトル</th><th>説明</th><th style="text-align:center;">作成者</th></tr>
                </thead>
                <tbody>
                    @foreach ($playlists as $playlist)
                        <tr>
                            <td class="w-25">
                                <a href="/musicApp/public/chat/{{ $playlist -> playlistId }}">
                                    <img src="{{ $playlist -> img }}" width="100px" height="100px'">
                                {{ $playlist -> playlistName }}</a>
                            </td>
                            <td>
                                <p style="font-size: 14px;">{{ $playlist -> description }}</p>
                            </td>
                            <td style="text-align:center;">
                                <p>{{ $playlist -> owner }}</p>
                            </td>
                        </tr>
                     @endforeach    
                </tbody>
            </table>
        </div>
    </body>
</html>    