<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新規登録</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script type="text/javascript">
            
            var Client_ID = "c952338e635a43308c36d5ebdee12aae"; 
            var Client_Secret = "effa2a4707f948159369e7708a899c9e"; 
           
            var base64 = btoa(Client_ID + ":" + Client_Secret); 
           
            var token="";
            var type="";
            function cancelSubmit() {
                var spotifyId = document.getElementById('spotifyid').value; //現在ログインしているアカウントのspotifyid
                var ajax = new XMLHttpRequest();
                ajax.open("post", "https://accounts.spotify.com/api/token");
                // サーバに対して解析方法を指定する
                ajax.setRequestHeader( 'Authorization', 'Basic '+ base64 );
                ajax.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
                // データをリクエスト ボディに含めて送信する
                ajax.send( "grant_type=client_credentials" );
                ajax.responseType = "json";
                ajax.addEventListener("load", function(){ // loadイベントを登録します。
                    var json = this.response;
                    token = json["access_token"];
            
                    var ajax2 = new XMLHttpRequest();
                    ajax2.open("get", "https://api.spotify.com/v1/users/"+ spotifyId);
                    ajax2.setRequestHeader( 'Authorization', 'Authorization: Bearer '+ token
                    );
                    ajax2.send();
                    ajax2.responseType = "json";
                    ajax2.addEventListener("load", function(){ // loadイベントを登録します。
                        var json2 = this.response;
                        var id = json2.id;
                        console.log(id);
                        if(id == spotifyId){
                            alert = 'ID一致';
                            return false;
                        }else{
                            return true;
                        }
                        // var pass = document.getElementById("password").value;
                        // var pass2 = document.getElementById("password2").value;
                        
                        // if (pass != pass2){
                        //     alert("パスワードと確認用パスワードが一致しません。");
                        //     return false;
                        // } else {
                        //     return true;
                        // }
                    }, false);
                },false);
            }   
            
        </script>
    </head>
    <body>
        <nav class="shadow-sm mb-5 navbar navbar-dark bg-dark">
            <a class="ml-5 navbar-brand" href="/musicApp/public">Music App</a>
        </nav>
        <div class="container w-50">
            <form id="loginForm" name="loginForm" action="" method="POST" onSubmit="return cancelSubmit();">
                @csrf
                <h3>新規登録フォーム</h3>
                <div class="mb-3">
                    <label class="ml-1">ユーザーID</label>
                        @isset($error_message1)
                            <p class="alert alert-danger" style="font-size:14px;" role="alert">{{$error_message1}}</p>
                        @endisset
                    <input type="text" class="form-control" name="username" id="username" placeholder="ユーザー名を入力" value="" required>
                </div>
                <div class="mb-3">
                    <label class="ml-1">Spotify ユーザー名</label>
                        @isset($error_message2)
                            <p class="alert alert-danger" style="font-size:14px;" role="alert">{{$error_message2}}</p>
                        @endisset
                    <p id="log"></p>    
                    <input type="text" class="form-control" id="spotifyid" name="spotifyid" placeholder="Spotify ユーザー名を入力" required>
                    <div class="text-right">
                        <a class="" href="https://www.spotify.com/jp/account/overview/?utm_source=spotify&utm_medium=menu&utm_campaign=your_account">ユーザー名の確認はこちら</a>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password">パスワード</label>
                    <input class="form-control" type="password" id="password" name="password" value="" placeholder="パスワードを入力" required>
                </div>
                <div class="mb-3">
                    <label for="password2">パスワード(確認用)</label>
                    <input class="form-control" type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力" required>
                </div>
                <div class="d-flex justify-content-between">
                    <input class="ml-3 btn btn-success" type="submit" id="register" name="register" value="登録">
                    <a href="/musicApp/public/login">ログイン画面に戻る</a>
                </div>
            </form>
        </div>
        <script type="text/javascript" src="">
            
            var log = document.getElementById('log');
        </script>
    </body>
</html>