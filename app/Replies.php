<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
        // Table Name
        protected $table = 'replies';
        // Primary key
        public $primaryKey = 'id';

        // User relation
        public function user()
        {
           return $this->belongsTo('App\User');
        }

        // Post relation
        public function post()
        {
           return $this->belongsTo('App\Post');
        }
}
