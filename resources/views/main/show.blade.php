<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>一件表示画面</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
   
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
               <a href="" class="btn btn-primary col-1 ml-3 mr-2">編集する</a>
               <form action="/musicApp/public/delete" method="POST" >
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
</script>
</body>
</html>