<?php

namespace App;

use App\Traits\Authorable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model{
    use SoftDeletes, Sluggable, Authorable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function author() {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
