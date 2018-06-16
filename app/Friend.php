<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    // Table Name
    protected $table = 'friends';
    // Primary key
    public $primaryKey = 'id';
}
