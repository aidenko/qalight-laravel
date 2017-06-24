<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = (Hash::needsRehash($password) ? bcrypt($password) : $password);
    }

    public function socialite() {
        return $this->hasOne('App\Socialite');
    }

    public function roles() {
        return $this->belongsToMany('App\Role');
    }

    public function createdArticles() {
        return $this->hasMany('App\Article');
    }

    public function authoredArticles() {
        return $this->hasMany('App\Article', 'author_id');
    }
}
