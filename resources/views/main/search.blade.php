<!DOCTYPE html>
<html lang="ja">
   <head>
      <meta charset="UTF-8">
      <title>マイページ</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <style>
         .table td{
             vertical-align: middle;
             height: 100px;
         }
      </style>
   </head>
   <body>
      @include('components.header')
      <div id="list" class="container">
         @if($search == null)
            <p style="font-size:18px;" class="text-center">お探しのプレイリストは見つかりませんでした。</p>
         @else
            <table class="table">
               <thead class="thead-light">
                    <tr><th  class="w-25">タイトル</th><th style="width: 60%;">説明</th><th style="text-align:center; width: 15%;">作成者</th></tr>
               </thead>
               <tbody>
                  @foreach ($search as $result)
                     <tr>
                        <td class="w-25">
                           <a href="/musicApp/public/chat/{{ $result -> playlistId }}">
                              <img src="{{ $result -> img }}" width="100px" height="100px'">
                           {{ $result -> playlistName }}</a>
                        </td>
                        <td class="w-50">
                           <p style="font-size: 14px;">{{ $result -> description }}</p>
                        </td>
                        <td class="w-25" style="text-align:center;">
                           <p><a href="https://open.spotify.com/user/{{ $result->spotifyId}}">{{ $result -> owner }}</a></p>
                        </td>
                     </tr>
                  @endforeach    
               </tbody>
            </table>
         @endif
      </div>
      
   </body>
</html>



