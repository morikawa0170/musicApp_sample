<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;
use App\Models\Comment;

class AppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //メインページを表示
    {
        session_start();
        if (!isset($_SESSION["NAME"])) {
            // セッション変数のNAMEがセットされていなかったら、未ログイン
            header("Location:login");
            exit;
        }
        
        return view('main.main');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Comment $comment) 
    {
        
        $title = str_replace("/musicApp/public/chat/", "",  $_SERVER['REQUEST_URI']);
        
        $link = mysqli_connect('morikawa.naviiiva.work', 'naviiiva_user', '!Samurai1234', 'morikawa');
        
 	    $query = "SELECT * from comments where title='".$title."' order by id desc";
 	    if ($result = mysqli_query($link, $query)) {
 		    $msg = array();
 		    foreach($result as $row) {
  		    $msg[] = array(
 				'msg'=>$row['msg']
 			);
 		    }
     	    header("Content-Type: application/json; charset=utf-8");
     	    echo json_encode($msg);
        }
        // dd($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //チャットの処理
    {   
        
        $comment = new Comment();
        $title = $request-> title;
        $msg = $request-> msg;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ //POST時のみタイトル（プレイリストid）とチャットをdbに登録
        	$comment-> title = $title;
        	$comment-> msg = $msg;
        	$comment-> save();
        	$save = $comment-> save();
        	if ($save) {
        // 		header("Location: chat?url=https://open.spotify.com/playlist/".$title);
        // 		exit;
                return redirect("/chat/$title");
        	}
        }
           
        // return view('main.chatajax');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function show($id) //プレイリスト詳細ページを表示
    {
        $title = Comment::find($id);
        return view('main.chat')->with('title', $title);

    }

    public function edit() //マイページを表示
    {
        return view('main.mypage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppUser $appUser) 
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppUser $appUser)
    {
        //
    }
}
