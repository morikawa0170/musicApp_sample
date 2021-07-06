<?php
   // $error_message = @$_SESSION['error_message'];
   //$_SESSION['error_message'] = "";
?>
<!doctype html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>ログインページ</title>
</head>
<body>
   <h1>ログイン画面</h1>
   <form id="loginForm" name="loginForm" action="" method="POST">
      {{ csrf_field() }}
      <fieldset>
         <legend>ログインフォーム</legend>
         <p>
            <label for="username">ユーザーID</label>
            <input type="text" id="username" name="username" placeholder="ユーザーIDを入力">
         </p>
         <p>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" value="" placeholder="パスワードを入力"><br>
         </p>
         <div>{{ session('error_message') }}</div>
         <input type="submit" id="login" name="login" value="ログイン">
      </fieldset>
   </form><br>
   <form action="register">
      <fieldset>
         <legend>登録がまだの方はこちら</legend>
         <input type="submit" value="新規登録">
      </fieldset>
   </form>
</body>
</html>