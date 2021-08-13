<?php
$url = str_replace("/musicApp/public/chat/", "",  $_SERVER['REQUEST_URI']);
$username = $_SESSION["NAME"];
?>
<!DOCTYPE html>
<html lang="ja">
   <head>
      <meta charset="UTF-8">
      <title>Spotify API test</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body>
      @include('components.header')
      <div class="container">
         <iframe class="d-block mt-3 mx-auto w-50" style="height: 500px" src="https://open.spotify.com/embed/playlist/{{ $url }}" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
         <br>
         <div class="row justify-content-center">
            <form  class="col-auto " action="/musicApp/public/chatajax/{{ $url }}" method="post">
               @csrf
               <input type="hidden" name="title" value="{{ $url }}">
               <input type="hidden" name="username" value="<?php echo $username; ?>">
               <input type="text" name="msg" size=80>
               <input type="submit" value="送信">
            </form>
         </div>
         <div id="chat" class=""></div>
         <script>
            function recvAJAX() {
               var ajax = new XMLHttpRequest();
               ajax.open("get", "/musicApp/public/chatajax/{{ $url }}");
               ajax.responseType = "json";
               ajax.send(); // 通信させます。
               ajax.addEventListener("load", function(){ // loadイベントを登録します。
                  var msg = document.getElementById("chat");
                  var json = this.response;
                  for(var i = json.length-1; i >= 0; i--) {
                     var str = json[i].created_at;
                     var replace = str.replace('T',' ');
                     var created_at = replace.substr(0,19);
                     var username = json[i].username;
                     var id = json[i].id;
                     var form = '<form action="/musicApp/public/chat/delete" method="post">'
                                 +"<input type='submit' class='btn btn-link' value='削除' onClick='return delCheck()'>"
                                 +"<input type='hidden' name='id' value='"+ id +"'>"
                                 +"<input type='hidden' name='title' value="+ "{{$url}}" +">"
                                 +"<input type='hidden' name='_token' value='{{ csrf_token() }}'>"
                                 +"</form>";
                     var myPost=    "<div class='card mb-2 mt-3 w-75 mx-auto'>" 
                                       +"<div class='card-body pl-5 pb-1 d-flex bd-highlight'>" 
                                          +'<p class="mr-auto p-1 bd-highlight">'+json[i].msg +'</p>'
                                          +'<p class="p-1 bd-highlight">'+ username +' /</p>'
                                          +'<p class="text-muted p-1 bd-highlight">'+ created_at +'</p>'
                                          +form
                                       +"</div>"
                                    +"</div>";
                     var otherPost = "<div class='card mb-2 mt-3 w-75 mx-auto'>" 
                                       +"<div class='card-body pl-5 pb-1 d-flex bd-highlight'>" 
                                          +'<p class="mr-auto p-1 bd-highlight">'+json[i].msg +'</p>'
                                          +'<p class="p-1 bd-highlight">'+ username +' /</p>'
                                          +'<p class="text-muted p-1 bd-highlight">'+ created_at +'</p>'
                                       +"</div>"
                                    +"</div>";         
                     if ("{{ $username }}" == username){
                        msg.innerHTML += myPost;
                     }else{
                        msg.innerHTML += otherPost;
                     }
                  }
               }, false);
            }
            // var handle = setInterval(recvAJAX, 200);
            var handle = recvAJAX();
            function delCheck(){
               var result = confirm('本当に削除してよろしいですか？');
               if(result == false){
                  return false;
               }
            }
         </script>
         
      </div>
   </body>
</html>