<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPanjarDetail extends Model
{
    protected $table = "ppanjar_detail";
    protected $primaryKey = 'no'; // or null
    public $timestamps = false;
    public $incrementing = false;
}
