<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SdmTblKdjab extends Model
{
    protected $table = "sdm_tbl_kdjab";
    protected $primaryKey = 'kdjab'; // or null
    public $timestamps = false;
    public $incrementing = false;
}
