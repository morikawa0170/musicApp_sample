<!doctype html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>ログインページ</title>
</head>
<body>
   <h1>ログイン画面</h1>
   <form id="loginForm" name="loginForm" action="" method="POST">
      <fieldset>
         <legend>ログインフォーム</legend>
         <p>
            <label for="userid">ユーザーID</label>
            <input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力">
         </p>
         <p>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" value="" placeholder="パスワードを入力"><br>
         </p>
         <input type="submit" id="login" name="login" value="ログイン">
      </fieldset>
   </form><br>
   <form action="register">
      <fieldset>          
         <legend>新規登録フォーム</legend>
         <input type="submit" value="新規登録">
      </fieldset>
   </form>
</body>
</html>