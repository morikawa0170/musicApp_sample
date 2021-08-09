<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Playlists;

class AppUserController extends Controller
{
    //メインページを表示
    public function index() 
    {
        session_start();
        if (!isset($_SESSION["NAME"])) {
            // セッション変数のNAMEがセットされていなかったら、未ログイン
            return redirect('login');
        }
        $name = $_SESSION["NAME"];
        $playlists = Playlists::all(); //プレイリストの情報を全件取得
        
        return view('main.main', ['playlists'=>$playlists, 'name'=>$name]);
    }

    //コメント表示機能
    public function chatShow($title) 
    {
        session_start();
        if (!isset($_SESSION["NAME"])) {
            // セッション変数のNAMEがセットされていなかったら、未ログイン
            return redirect('login');
        }
        //$title(spotifyid)のみを取得
        $comments = Comment::where('title',$title)->get(); 
        
        //$titleを連想配列で表示
 	    if ($comments) {
 		    $msg = array();
 		    foreach($comments as $row) {
      		    $msg[] = array(
     				'msg'=>$row['msg'],
     				'created_at'=>$row['created_at']
     			);
 		    }
 		    //chatでJsonを呼び込んで表示させるため、Jsonに変換して表示
 		    return response()->json($msg);
        }
    }

    //コメント登録機能
    public function chatStore(Request $request) 
    {   
        session_start();
        if (!isset($_SESSION["NAME"])) {
            // セッション変数のNAMEがセットされていなかったら、未ログイン
            return redirect('login');
        }
        //コメントを投稿
        $comment = new Comment();
        $title = $request-> title;
        $msg = $request-> msg;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ //POST送信時のみタイトル（プレイリストid）とチャットをdbに登録
        	$comment-> title = $title;
        	$comment-> msg = $msg;
        	$comment-> save();
        	$save = $comment-> save();
        	if ($save) {
                return redirect("/chat/$title");
        	}
        }
    }
    
    //チャットページを表示
    public function chat($id) 
    {
        session_start();
        if (!isset($_SESSION["NAME"])) {
            // セッション変数のNAMEがセットされていなかったら、未ログイン
            return redirect('login');
        }
        
        $title = Comment::find($id); //表示しているプレイリストのIDを取得
        return view('main.chat',compact('title'));
    }
    
    //マイページを表示
    public function mypage() 
    {
        session_start();
        if (!isset($_SESSION["NAME"])) {
            // セッション変数のNAMEがセットされていなかったら、未ログイン
            return redirect('login');
        }
        $username = $_SESSION["NAME"];
        // $playlistIdCount = AppUser::where('playlistId',$playlistId)->count();
        $user_data = AppUser::where('username', $username)->first();
        return view('main.mypage', compact('user_data'));
    }

    public function search(Request $request) 
    {
        $search = Playlists::where('playlistName', 'like', "%$request->search%")->get();
        $searchC = Playlists::where('playlistName', 'like', "%$request->search%")->count();
        if ($searchC==0) {
            $search = false;
        }
        
        return view('main.search', compact('search'));
    }
    
}   
    