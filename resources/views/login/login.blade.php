<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>ログインページ</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
   <nav class="shadow-sm mb-5 navbar navbar-dark bg-dark">
      <a class="ml-5 navbar-brand" href="/musicApp/public">Music App</a>
   </nav>
   <div class="container w-50">
      <form id="loginForm" name="loginForm" action="" method="POST">
         {{ csrf_field() }}
         <legend for="username">ログインフォーム</legend>
         <div class="form-group">
            <label>ユーザーID</label>
            <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="ユーザーID">
         </div>
         <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" class="form-control" id="password" name="password" value="" placeholder="パスワード">
         </div>
         <input  type="submit" class="btn btn-primary" id="login" name="login" value="ログイン">
      </form>
      <form action="register">
         <input type="submit" class="btn btn-link" value="新規登録">
      </form>
   </div>
</body>
</html>