<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\AppUser;
// use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
   //ログインを行う
   public function login(Request $request)
   {
      //  dd($request);
      session_start();
      $username = $request->username;
      $password = $request->password;
      $result = AppUser::Where('username', $username)->get();
      foreach($result as $row){
         if (password_verify($password, $row['password'])) {
            session_regenerate_id(true);
            
            $_SESSION["NAME"] = $row['username'];
            return redirect('/');
         }
      }
      $_SESSION['error_message'] = 'ログインのユーザまたはパスワードが違っています。';
      return redirect('/login');
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
      //db->カラム名 = $request -> name属性の値
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
      
      if (isset($_SESSION["NAME"])) {
         
         return redirect('/login');
         $errorMessage = "ログアウトしました。";
      
      } else {
         $errorMessage = "セッションがタイムアウトしました。";
      }
      //セッション変数のクリア
      $_SESSION = array();
       
      //セッションのクリア
      @session_destroy();
      
      
   }
}
