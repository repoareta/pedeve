<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userlog extends Model
{
    protected $table="userlog";
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
