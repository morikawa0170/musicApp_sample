<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新規登録</title>
        <style>
            fieldset p label {
                width:160px;
                display:inline-block;
            }
        </style>
        <script type="text/javascript">
            function passCheck() {
                var pass = document.getElementById("password").value;
                var pass2 = document.getElementById("password2").value;
                
                if (pass != pass2){
                    alert("パスワードと確認用パスワードが一致しません。");
                    return false;
                } else {
                    return true;
                }
            };
            
        </script>
    </head>
    <body>
        <h1>新規登録画面</h1>
        <form id="loginForm" name="loginForm" action="" method="POST" onSubmit="return passCheck();">
            {{ csrf_field() }}
            <fieldset>
                <legend>新規登録フォーム</legend>
                <p>
                    <label for="username">ユーザーID</label>
                    <input type="text" id="username" name="username" placeholder="ユーザー名を入力" value="" required>
                </p>
                <p>
                    <label for="spotifyid">Spotify ユーザー名</label>
                    <input type="spotifyid" id="spotifyid" name="spotifyid" value="" placeholder="Spotify ユーザー名" required><br>
                    <a style="font-size:14px; margin-left: 165px;" href="https://www.spotify.com/jp/account/overview/?utm_source=spotify&utm_medium=menu&utm_campaign=your_account">ユーザー名の確認はこちら</a>
                </p>
                <p>
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" value="" placeholder="パスワードを入力" required>
                </p>
                <p>
                    <label for="password2">パスワード(確認用)</label>
                    <input type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力" required>
                </p>
                <input style="margin-left:250px" type="submit" id="register" name="register" value="登録">
            </fieldset>
        </form>
        <br>
        <form action="login">
            {{ csrf_field() }}
            <input type="submit" value="ログイン画面に戻る">
        </form>
    </body>
</html>