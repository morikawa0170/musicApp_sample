<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ</title>
        <style type="text/css" src="style.css"></style>
        <style>
            th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <form>
            <label>ユーザー名:<input type="text" name="playlist" id="playlist"></label>
            <button onclick="search();return false;">検索</button>
        </form>
        <div id="list"></div>
        <script src="{{asset('/js/appUsers.js')}}"></script>
    </body>
</html>