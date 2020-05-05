<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ttable extends Model
{
    protected $table = "t_table";
    protected $primaryKey = null; // or null
    public $timestamps = false;
    public $incrementing = false; //t_table
}
