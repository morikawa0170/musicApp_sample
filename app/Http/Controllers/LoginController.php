<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\AppUser;

class LoginController extends Controller
{
   
   //ログインを行う
   public function login(Request $request)
   {
      session_start();
      //  dd($request);
         $username = $request->username;
         $password = $request->password;
         $spotifyid = $request->spotifyid;
         $result = AppUser::Where('username', $username)->get();
         $user_data = [
               'username' => $username,
               'password' => $password,
               'spotifyid' => $spotifyid
         ];
         foreach($result as $row){
            if (password_verify($password, $row['password'])) {
               session_regenerate_id(true);
               
               $_SESSION["NAME"] = $row['username'];
               return redirect('/');
            }
         }
         
      return redirect('/login');
   }
   
   //登録フォーム画面表示
   public function registerForm()
   {
      
      return view('login.register',['error_message' => '']);
   }
   
   //新規登録機能
   public function register(Request $request)
   {
      // dd($request);
      $username = $request->username;
      $spotifyid = $request->spotifyid;
      $password = $request->password;
      
      //db->カラム名 = $request(POSTされたvalueの値)->name属性名
      $AppUser = new AppUser();
      $AppUser-> username = $username;
      $AppUser-> spotifyid = $spotifyid;
      $AppUser-> password = $password;
      $AppUser-> password = password_hash("$password",PASSWORD_DEFAULT); //パスワードをハッシュ化
      
      $usernameC = AppUser::where('username',$username)->count();
      $spotifyidC = AppUser::where('spotifyid',$spotifyid)->count();
      
      if($usernameC == 0 && $spotifyidC == 0) {
         $AppUser-> save();
         return redirect('/login');
      }else if($usernameC == 1 && $spotifyidC == 0){
         return view('login.register',[
            'error_message1'=>'指定されたユーザー名は既に登録されています。',
            'username' => $username,
            'spotifyid' => $spotifyid,
            'password' => $password
         ]);   
      }else if($usernameC == 0 && $spotifyidC == 1){
         return view('login.register',[
            'error_message2'=>'指定されたSpotify ユーザー名は既に登録されています。',
            'username' => $username,
            'spotifyid' => $spotifyid,
            'password' => $password
         ]);
      }else{
         return view('login.register',[
            'error_message1'=>'指定されたユーザー名は既に登録されています。',
            'error_message2'=>'指定されたSpotify ユーザー名は既に登録されています。',
            'username' => $username,
            'spotifyid' => $spotifyid,
            'password' => $password
         ]);
      }
   }
   
   //ログアウトを行う
   public function logout(Request $request)
   {
      session_start();
      // セッションの変数のクリア
      $_SESSION = array();
      // セッションクリア
      session_destroy();
      // return redirect('/login');
      return view('login.logout');
   }
}
