<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class Penghargaan extends Model
{
    use CompositeKey;

    protected $table = "sdm_penghargaan";
    protected $primaryKey = ['nopeg', 'tanggal', 'nama', 'pemberi'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    const CREATED_AT = 'tglentry';
}
