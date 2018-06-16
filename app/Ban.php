<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    // Table Name
    protected $table = 'bans';
    // Primary key
    public $primaryKey = 'id';
}
