<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   
    public function destroy(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        Comment::findOrFail($id)->delete();
        
        return redirect("/chat/$title");
    }
}
