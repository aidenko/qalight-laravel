<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function articles(){
        return $this->hasMany('App\Article');
    }

    public function children(){
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function parent(){
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function descendants(){

        //$descendents = [];

        //$children = $this->children;

        $d = Category::with('children')->where('parent_id', $this->id)->get();
        $d = $d->pluck('id');

        var_dump($d);
    }
}
