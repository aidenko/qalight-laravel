<?php

namespace App\Traits;


use App\User;

trait Authorable{

    public function isAuthor(User $user) {
        return $user->id == $this->attributes['author_id'];
    }

    public function isCreator(User $user) {
        return $user->id == $this->attributes['user_id'];
    }

    public function isOwner(User $user) {
        return ($this->isAuthor($user) || $this->isCreator($user));
    }
}