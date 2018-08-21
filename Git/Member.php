<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // Table Name
    protected $table = 'members';
    // Primary key
    public $primaryKey = 'id';
}
