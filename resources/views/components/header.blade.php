<?php $uri = $_SERVER['REQUEST_URI'];?>
<nav class="navbar fixed-top navbar-dark bg-dark">
   <a class="ml-5 navbar-brand" href="/musicApp/public">Music App</a>
   <ul class="justify-content-around navbar-nav mr-auto flex-row">
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
      <li class="nav-item">
         
         <form action="logout" method="POST">
            @csrf
            <input type="submit" class="nav-link btn btn-link" href="#" value="ログアウト">
         </form>   
      </li>
   </ul>
   <form class="form-inline">
      <input class="form-control mr-sm-2 border-info" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
   </form>
</nav>
<div style="margin-top:100px;"></div>