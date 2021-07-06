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
         
      return redirect('/login')->with('error_message', 'ユーザIDまたはパスワードが違っています。');
   }
   
   //新規登録機能
   public function register(Request $request)
   {
      // dd($request);
      $username = $request->username;
      $spotifyid = $request->spotifyid;
      $password = $request->password;
      $errorMessage = "";
      $errorMessage2 = "";
      //db->カラム名 = $request(POSTされた値) -> name属性の値
      $AppUser = new AppUser();
      $AppUser-> username = $username;
      $AppUser-> spotifyid = $spotifyid;
      $AppUser-> password = $password;
      $AppUser-> password = password_hash("$password",PASSWORD_DEFAULT); //ハッシュ化したpassを代入
      
      $usernameC = AppUser::where('username',$username)->count();
      $spotifyidC = AppUser::where('spotifyid',$spotifyid)->count();
      
      if ($usernameC == 1) {
         return redirect('/register');
         $errorMessage1 = "指定されたユーザーIDは既に登録されています。";
         
      } else if ($spotifyidC == 1) {
         return redirect('/register');
         $errorMessage2 = "指定されたSpotify ユーザー名は既に登録されています。";
         
      } else {
         $AppUser-> save();
         return redirect('/login');
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
