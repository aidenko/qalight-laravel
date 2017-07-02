<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller{
    public function add(Request $request) {
        $type = $request->type;
        $commentable = $type::find($request->id);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->text = $request->text;

        $commentable->comments()->save($comment);
    }
}
