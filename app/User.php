<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public function immediate_permissions() {
        return $this->belongsToMany('App\Permission')->withPivot('include');
    }

    public function role_permissions() {
        $permissions = [];

        foreach($this->roles as $role)
            $permissions = array_merge($permissions, $role->permissions->pluck('id')->toArray());

        return Permission::whereIn('id', $permissions)->get();
    }

    public function permissions() {

        $permissions = $this->immediate_permissions;

        $exclude = [];
        $include = [];

        foreach($permissions as $p) {
            if($p->pivot->include)
                $include[] = $p;
            else
                $exclude[] = $p->id;
        }

        $permissions = $this->role_permissions()->whereNotIn('id', $exclude)->merge($include)->unique('id');

        return $permissions;

    }

    public function hasPermission($permission){
        return $this->permissions()->pluck('name')->contains($permission);
    }

    public function isAdmin(){
        return $this->hasPermission('admin_access');
    }

    public function isSuperAdmin(){
        return $this->hasPermission('super_admin');
    }
}
