<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Role extends Model{
    use SoftDeletes, NodeTrait;

    protected $fillable = ['name'];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function children() {
        return $this->hasMany('App\Role', 'parent_id');
    }

    public function parent() {
        return $this->belongsTo('App\Role', 'parent_id');
    }

    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }

    public function hasPermission($permission) {
        return $this->permissions->pluck('name')->contains($permission);
    }

    public function isAdmin() {
        return $this->hasPermission('admin.access');
    }

    public function isSuperAdmin() {
        return $this->hasPermission('admin.super');
    }
}
