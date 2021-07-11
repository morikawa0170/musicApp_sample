<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>詳細ページ</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
@include('components.header')
<div class="container mt-5">
   <div class="card">
      <div class="card-header align-middle mb-0">
         <h4>{{ $playlistName }}</h4>
      </div>
      <div class="card-body">
         <div class="row">
            <img src="{{$img}}" class="card-text col-2 mb-2">
            <p class="ml-3">{{ $description }}</p>
         </div>
         <p class="text-right">プレイリスト作成者：<a href="https://open.spotify.com/user/{{ $spotifyId }}">{{ $owner }}</a></p>
         <div class="row pt-2">
            @if ("$state" == "registered")
               <form action="/musicApp/public/update" id="update" method="POST">
                  @csrf
                  <input type="submit" value="更新する" class="btn btn-primary ml-3 mr-2" onClick="return updateclick()">
                  <input type="hidden" name="id" value="{{$id}}">
               </form>
               <form action="/musicApp/public/delete" method="POST">
                  @csrf
                  <input type="hidden" name="playlistId" value="{{$playlistId}}" id="delete">
                  <input type="submit" class="btn btn-danger" value="削除する" onClick="return dltclick()">
               </form>
            @else
               <form action="/musicApp/public/create" method="POST">
                  @csrf
                  <input type="submit" class="btn btn-success ml-3 mr-2" value="登録する">
                  <input type="hidden" name="spotifyId"  value="{{$spotifyId}}">
                  <input type="hidden" name="playlistId"  value="{{$playlistId}}">
                  <input type="hidden" name="playlistName"  value="{{$playlistName}}">
                  <input type="hidden" name="username"  value="{{$username}}">
                  <input type="hidden" name="description"  value="{{$description}}">
                  <input type="hidden" name="img"  value="{{$img}}">
               </form>
            @endif 
         </div>
      </div>
   </div>
   <div>
      <a href="/musicApp/public/mypage" class="ml-1">back</a>
   </div>
</div>
<script>
   function dltclick() {
      var result = confirm('本当に削除してよろしいですか？');
      if(result == false) {
         return false;
      }
   }   
   
   function updateclick() {
      var result = confirm('プレイリストの情報を最新の状態に更新します。');
      if(result == false) {
         return false;
      }
   } 
   
   var Client_ID = "c952338e635a43308c36d5ebdee12aae"; 
   var Client_Secret = "effa2a4707f948159369e7708a899c9e"; 
   
   var base64 = btoa(Client_ID + ":" + Client_Secret); 
   
   var token="";
   var type="";
   function update() {
      var spotifyId ="{{$spotifyId}}"; //現在ログインしているアカウントのspotifyid
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
         ajax2.open("get", "https://api.spotify.com/v1/playlists/{{$playlistId}}");
         ajax2.setRequestHeader( 'Authorization', 'Authorization: Bearer '+ token);
         ajax2.send();
         ajax2.responseType = "json";
         ajax2.addEventListener("load", function(){ // loadイベントを登録します。
            var json2 = this.response;
            var update = document.getElementById('update');
            var playlistId = json2.id;
            var playlistName = json2.name;
            var description = json2.description;
            var img = json2.images[0].url;
            var button ="<input type='hidden' name='playlistId' value='"+playlistId+"'>"
                       +"<input type='hidden' name='playlistName' value='"+playlistName+"'>"
                       +"<input type='hidden' name='description' value='"+description+"'>"
                       +"<input type='hidden' name='img' value='"+img+"'>";
            update.insertAdjacentHTML('beforeend',button);
         });
      });
   }   
   var hundle = update();
</script>
</body>
</html>