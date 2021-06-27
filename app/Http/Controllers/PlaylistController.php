<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlists;

class PlaylistController extends Controller
{
   public function create(Request $request) //プレイリスト情報登録機能
   {
      $playlist = new Playlists();
      $playlist->spotifyId = $request-> spotifyId;
      $playlist->playlistId = $request-> playlistId;
      $playlist->playlistName = $request-> playlistName;
      $playlist->owner = $request-> owner;
      $playlist->description = $request-> description;
      $playlist->save();
      return redirect('/');
      
   }
}
