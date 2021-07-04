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
            <a href="" class="btn btn-primary col-1 ml-3 mr-2">編集する</a>
            <form method="POST" action="" id="">
               @csrf
               <a href="" class="btn btn-danger">削除する</a>
            </form>
         </div>
      </div>
   </div>
   <div>
      <a href="/musicApp/public/mypage" class="ml-1">back</a>
   </div>
</div>   
</body>
</html>