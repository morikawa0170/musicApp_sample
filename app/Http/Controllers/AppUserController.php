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
            return redirect('login');
        }
        $name = $_SESSION["NAME"];
        $username = [
            'username' => $name
        ];
        return view('main.main', $username);
        
    }

    public function create($title) //コメント表示機能
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
     				'msg'=>$row['msg']
     			);
 		    }
 		    //chatでJsonを呼び込んで表示させるため、Jsonに変換して表示
 		    return response()->json($msg); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //チャットの処理
    {   
        session_start();
        if (!isset($_SESSION["NAME"])) {
            // セッション変数のNAMEがセットされていなかったら、未ログイン
            return redirect('login');
        }
        
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
           
        // return view('main.chatajax');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function show($id) //チャットページを表示
    {
        session_start();
        if (!isset($_SESSION["NAME"])) {
            // セッション変数のNAMEがセットされていなかったら、未ログイン
            return redirect('login');
        }
        $title = Comment::find($id);
        return view('main.chat',compact('title'));
    }

    public function edit($username) //マイページを表示
    {
        session_start();
        if (!isset($_SESSION["NAME"])) {
            // セッション変数のNAMEがセットされていなかったら、未ログイン
            return redirect('login');
        }
        
        $user_data = AppUser::where('username', $username)->first();
        // $result = array();
        // foreach($user_data as $row){
        //     echo $user_data[$row[1]] = $row[0];
        // }
        // return view('main.mypage', ['user_data' => $user_data]);
        return view('main.mypage', compact('user_data'));
        // return $user_data;
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
