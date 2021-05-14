<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>Spotify API test</title>
        <style type="text/css" src="style.css"></style>
        <style>
            th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
@section('title', 'メインぺージ')

        <h1>メインページ</h1>

        <a href="logout">ログアウト</a>
        <form>
            <label>ユーザー名:<input type="text" name="playlist" id="playlist"></label>
            <button onclick="search();return false;">検索</button>
            <!--<iframe src="https://open.spotify.com/embed/playlist/50i6oJZYwd58vlVd5zYtr5" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>-->
        </form>
        <div id="list"></div>
        <script>
            var Client_ID = "c952338e635a43308c36d5ebdee12aae"; 
            var Client_Secret = "effa2a4707f948159369e7708a899c9e"; 
            
            var base64 = btoa(Client_ID + ":" + Client_Secret); 
            
            var token="";
            var type="";
            function search() {
                var userID = document.getElementById("playlist").value;
                //var userID ="winningkyoudi567";
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
                    ajax2.open("get", "https://api.spotify.com/v1/users/"+ userID +"/playlists?offset=0&limit=10");
                    ajax2.setRequestHeader( 'Authorization', 'Authorization: Bearer '+ token
                    );
                    ajax2.send();
                    ajax2.responseType = "json";
                    ajax2.addEventListener("load", function(){ // loadイベントを登録します。
                        var html="<table>"
                        html+="<tr><th>タイトル</th><th>コメント</th></tr>"
                        var json2 = this.response;
                        for (var i=0;i<json2.items.length;i++) {
                            var name=json2.items[i].name;
                            var url=json2.items[i].external_urls.spotify;
                            var img=null;
                             if (json2.items[i].images.length > 2) {
                                  img=json2.items[i].images[2].url;
                             }
                            html += "<tr><td><a href='playsub.php?url="+encodeURI(url)+"'>";
                            if (img!=null) {
                                html += "<img src='"+img+"'width=100px height=100px'>";
                            }
                            html += name+"</a></td><td><textarea name='comment'></textarea></td></tr>";
                        }
                        var list = document.getElementById("list");
                        list.innerHTML = html + "</table>";
                    }, false);
                }, false);
            }
        </script>
    </body>
</html>