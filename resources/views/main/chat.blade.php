<?php
$title = str_replace("/musicApp/public/chat/", "",  $_SERVER['REQUEST_URI']);
// $url = str_replace("https://open.spotify.com/","https://open.spotify.com/embed/", urldecode(@$_GET['url']));
// echo $title."<br>";
?>
<!DOCTYPE html>
<html lang="ja">
   <head>
      <meta charset="UTF-8">
      <title>Spotify API test</title>
      <style>
         div {
            display: inline-block;
         }
      </style>
   </head>
   <body>
      <iframe src="https://open.spotify.com/embed/playlist/{{ $title }}" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
      <div>
         <div id="chat"></div>
         <form action="/musicApp/public/chatajax/{{ $title }}" method="post">
            @csrf
            <input type="hidden" name="title" value="{{ $title }}">
            <input type="text" name="msg" size=80>
            <input type="submit" value="送信">
         </form>
         <a href="/musicApp/public/mypage">Myページに戻る</a>
         <script>
            function recvAJAX() {
               var ajax = new XMLHttpRequest();
               ajax.open("get", "/musicApp/public/chatajax/{{ $title }}>");
               ajax.responseType = "json";
               ajax.send(); // 通信させます。
               ajax.addEventListener("load", function(){ // loadイベントを登録します。
                  var msg = document.getElementById("chat");
                  var json = this.response;
                  msg.innerHTML = "<ul>";
                  for(var i = 0; i < json.length; i++) {
                     msg.innerHTML += "<li>" + json[i].msg + "</li><br>";
                  }
                  msg.innerHTML += "</ul>";
               }, false);
            }
            var handle = setInterval(recvAJAX, 200); //200msごとにrecvAJAXを実行(チャット内容を表示)。
         </script>
         
      </div>
      <!--<ifarme src="chat.php?title=<?php //echo $title;?>"></iframe>-->
   </body>
</html>