<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PUmkDetail extends Model
{
    protected $table = "pumk_detail";
    protected $primaryKey = 'no'; // or null
    public $timestamps = false;
    public $incrementing = false;
}
