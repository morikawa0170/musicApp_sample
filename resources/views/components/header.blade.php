<?php $uri = $_SERVER['REQUEST_URI'];?>
<nav class="shadow-sm mb-5 navbar fixed-top navbar-dark bg-dark">
   <a class="ml-5 navbar-brand" href="/musicApp/public">Music App</a>
   <ul class="navbar-nav mr-auto flex-row">
      @if($uri == "/musicApp/public/")
         <li class="nav-item active ml-5 mr-5">
           <a class="nav-link" href="/musicApp/public">ホーム<span class="sr-only">(current)</span></a>
      @else
         <li class="nav-item ml-5 mr-5">
            <a class="nav-link" href="/musicApp/public">ホーム</a>
      @endif  
      </li>
      @if($uri == "/musicApp/public/mypage")
         <li class="nav-item active mr-5">
           <a class="nav-link" href="mypage">マイページ<span class="sr-only">(current)</span></a>
      @else
         <li class="nav-item mr-5">
            <a class="nav-link" href="mypage">マイページ</a>
      @endif  
      </li>
      <li class="nav-item ml-auto">
         <form action="logout" method="POST">
            @csrf
            <input type="submit" class="nav-link btn btn-link" value="ログアウト">
         </form>   
      </li>
   </ul>
   @if($uri == "/musicApp/public/")
      <form class="form-inline mr-5">
         <input class="form-control mr-sm-2 border-info" type="search" placeholder="タイトル名で検索" aria-label="Search">
         <button class="btn btn-outline-info my-2 my-sm-0" type="submit">検索</button>
      </form>
   @endif
</nav>
<div style="margin-top:100px;"></div>