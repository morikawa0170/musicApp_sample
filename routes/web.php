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

// ログインを実行
Route::post('/login', [LoginController::class, 'login']);

//ログアウトを実行
Route::get('/logout', [LoginController::class,'logout']);

//マイページを表示
Route::get('/mypage',[AppUserController::class,'update']);

//チャット画面を表示
Route::get('/chat',[AppUserController::class,'show']);


Route::post('/chatajax',[AppUserController::class,'store']);

Route::get('/chatajax',[AppUserController::class,'create']);

Route::get('/register/', function (){
    return view('login.register');
});

Route::post('/register', [LoginController::class, 'register']);


