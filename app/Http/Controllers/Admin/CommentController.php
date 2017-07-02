<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Commentable;
use Illuminate\Http\Request;

class CommentController extends Controller{
    public function index(Request $request) {
        return view('themes.admin.html.article.comments', [
            'commentable' => Commentable::$commentable_types[$request->commentable_type]::find($request->commentable_id)
        ]);
    }
}
