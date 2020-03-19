<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggaranMain extends Model
{
    protected $table = "anggaran_main";
    protected $primaryKey = 'kode_main'; // or null
    public $timestamps = false;
    public $incrementing = false;
}
