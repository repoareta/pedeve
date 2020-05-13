<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggaranDetail extends Model
{
    protected $table = "anggaran_detail";
    protected $primaryKey = 'kode'; // or null
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
}
