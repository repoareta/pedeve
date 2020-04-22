<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class PengalamanKerja extends Model
{
    use CompositeKey;

    protected $table = "sdm_pengkerja";
    protected $primaryKey = ['nopeg', 'mulai'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    const CREATED_AT = 'tglentry';
}
