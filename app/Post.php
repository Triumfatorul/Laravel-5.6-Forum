<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    protected $table = 'posts';
    // Primary key
    public $primaryKey = 'id';

    // User relation
    public function user()
    {
       return $this->belongsTo('App\User');
    }

    // Post relation
    public function replies() 
    {
        return $this->hasMany('App\Replies');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
