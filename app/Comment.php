<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model{
    use SoftDeletes, NodeTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function commentable() {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
