<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;

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
    public function create() 
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function show(AppUser $appUser) //プレイリスト詳細ページを表示
    {
        return view('main.chat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AppUser $appUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppUser $appUser) //マイページを表示
    {
        return view('main.mypage');
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
