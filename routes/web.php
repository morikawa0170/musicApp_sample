<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AppUserController;
use App\Http\Controllers\PlaylistController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[AppUserController::class,'index']);
Route::post('/search',[AppUserController::class,'search']);

Route::get('/login/', function (){
   return view('login.login');
});
Route::post('/login', [LoginController::class, 'login']); // ログインを実行
Route::post('/logout', [LoginController::class,'logout']); //ログアウトを実行


Route::post('/create', [PlaylistController::class, 'create']);//プレイリスト登録機能
Route::get('/mypage',[AppUserController::class,'mypage']); //マイページを表示
Route::post('/mypage/show/{spotifyid}',[PlaylistController::class,'show']); //プレイリスト詳細ページ
Route::post('/delete',[PlaylistController::class,'destroy']); //プレイリスト削除機能
Route::post('/update',[PlaylistController::class,'update']); //プレイリスト更新機能
Route::get('/chat/{title}',[AppUserController::class,'chat']); //チャット画面を表示
Route::post('/chatajax/{title}',[AppUserController::class,'chatStore']); //チャットの処理
Route::get('/chatajax/{title}',[AppUserController::class,'chatShow']); //チャットを表示


Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/register',[LoginController::class,'registerForm']);


