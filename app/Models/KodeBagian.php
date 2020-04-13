<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeBagian extends Model
{
    protected $table = "sdm_tbl_kdbag";
    protected $primaryKey = 'kode'; // or null
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
}
