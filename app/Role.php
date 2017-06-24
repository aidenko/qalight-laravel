<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Role extends Model{
    use SoftDeletes, NodeTrait;

    protected $fillable = ['name', 'slug'];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
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
}
