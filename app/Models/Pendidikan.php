<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = "sdm_tbl_pendidikan";
    protected $primaryKey = 'kode'; // or null
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
}
