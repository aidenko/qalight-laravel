<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller{
    public function index(Request $request) {

        $type = '\App\\'.ucfirst($request->commentable_type);

        return view('themes.admin.html.comment.comments', [
            'commentable' => $type::find($request->commentable_id)
        ]);
    }
}
