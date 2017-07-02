<?php

namespace App;

use App\Traits\Commentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable{
    use Notifiable, Commentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    private $permissions = null;
    private $role_permissions = null;

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

    public function immediate_permissions() {
        return $this->belongsToMany('App\Permission')->withPivot('include');
    }

    public function role_permissions() {

        if($this->role_permissions === null){

            $permissions = [];

            foreach($this->roles as $role)
                $permissions = array_merge($permissions, $role->permissions->pluck('id')->toArray());

            $this->role_permissions = Permission::whereIn('id', $permissions)->get();
        }

        return $this->role_permissions;
    }

    public function permissions() {

        if($this->permissions === null){

            $permissions = $this->immediate_permissions;

            $exclude = [];
            $include = [];

            foreach($permissions as $p) {
                if($p->pivot->include)
                    $include[] = $p;
                else
                    $exclude[] = $p->id;
            }

            $this->permissions = $this->role_permissions()->whereNotIn('id', $exclude)->merge($include)->unique('id');
        }

        return $this->permissions;
    }

    public function hasPermission($permission) {
        return $this->permissions()->pluck('name')->contains($permission);
    }

    public function isAdmin() {
        return $this->hasPermission('admin.access');
    }

    public function isSuperAdmin() {
        return $this->hasPermission('admin.super');
    }

    public function isAuthorOf(Model $model) {
        if(method_exists($model, 'isAuthor'))
            return $model->isAuthor($this);

        return false;
    }

    public function isCreatorOf(Model $model) {
        if(method_exists($model, 'isCreator'))
            return $model->isCreator($this);

        return false;
    }

    public function isOwnerOf(Model $model) {
        if(method_exists($model, 'isOwner'))
            return $model->isOwner($this);

        return false;
    }
}
