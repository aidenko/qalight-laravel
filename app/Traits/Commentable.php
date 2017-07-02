<?php
/**
 * Created by PhpStorm.
 * User: Artem Kolombet
 * Date: 02.07.2017
 * Time: 10:43
 */

namespace App\Traits;


use App\Comment;
use Illuminate\Support\Facades\Auth;

trait Commentable{
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function hasComments() {
        return $this->comments->count();
    }

    public function addComment($title = null, $text, $parent_comment_id = null) {

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->title = $title;
        $comment->text = $text;
        $comment->parent_id = $parent_comment_id;

        $this->comments()->save($comment);
    }
}