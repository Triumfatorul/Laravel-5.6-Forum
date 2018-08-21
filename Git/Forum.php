<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    // Table Name
    protected $table = 'forums';
    // Primary key
    public $primaryKey = 'id';
}
