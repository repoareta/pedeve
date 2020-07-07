<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Userpdv extends Model
{
    use SoftDeletes;

    protected $table="userpdv";

    protected $primaryKey = 'userid';
    public $incrementing = false;
    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
