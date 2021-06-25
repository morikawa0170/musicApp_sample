<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AppUserController;


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

Route::get('/login/', function (){
    return view('login.login');
});

Route::get('/mypage/{username}',[AppUserController::class,'mypage']); //マイページを表示
Route::get('/chat/{title}',[AppUserController::class,'chat']); //チャット画面を表示
Route::post('/login', [LoginController::class, 'login']); // ログインを実行
Route::get('/logout', [LoginController::class,'logout']); //ログアウトを実行
Route::post('/chatajax/{title}',[AppUserController::class,'chatStore']); //チャットの処理
Route::get('/chatajax/{title}',[AppUserController::class,'chatShow']); //チャットを表示


Route::get('/register/', function (){ //新規登録
    return view('login.register');
});
Route::post('/register', [LoginController::class, 'register']);


