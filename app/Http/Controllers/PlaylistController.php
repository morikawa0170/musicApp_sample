<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlists;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PlaylistController extends Controller
{
   //プレイリスト情報登録機能
   public function create(Request $request) 
   {
      
      $playlist = new Playlists();
      $playlist->spotifyId = $request-> spotifyId; //spotifyID
      $playlist->playlistId = $request-> playlistId; //プレイリストID
      $playlist->playlistName = $request-> playlistName; //プレイリスト名
      $playlist->owner = $request-> username; //プレイリスト作成者(musicAppのユーザ名)
      $playlist->description = $request-> description; //プレイリスト説明文
      $playlist->img = $request-> img; //プレイリスト画像
      $playlist->save();
         
      return redirect('/');
   }
   
   //プレイリスト詳細ページ
   public function show(Request $request)
   {
      // dd($request);
      // registered
      $state = '';
      $playlistC = Playlists::where('playlistId',$request->playlistId)->count();
      
      if($playlistC >= 1) {
         $state = 'registered';
      }

      $data = [
            "spotifyId" => $request-> spotifyId,
            "playlistId" => $request-> playlistId,
            "playlistName" => $request-> playlistName,
            "owner" => $request-> owner,
            "username" => $request-> username,
            "description" => $request-> description,
            "img" => $request-> img,
            'state' => $state
         ];
      
      return view('main.show',$data);
   }
   
   public function destroy(Request $request)
   {
      // dd($request);
      $playlist = Playlists::where('playlistId',$request->playlistId)->first();
      $playlisId = $playlist->id;
      Playlists::findOrFail($playlisId)->delete();
      // $comments = Comments::findOrFail($request->playlistId);
      // $comments-> delete();
     
      return redirect('/');
   }
}
