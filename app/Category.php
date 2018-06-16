<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Table Name
    protected $table = 'categories';
    // Primary key
    public $primaryKey = 'id';

    public function post()
    {
    	return $this->hasMany('App\Post');
    }
}
