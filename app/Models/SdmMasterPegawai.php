<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SdmMasterPegawai extends Model
{
    protected $table = "sdm_master_pegawai";
    protected $primaryKey = 'nopeg'; // or null
    public $timestamps = false;
    public $incrementing = false;
}
