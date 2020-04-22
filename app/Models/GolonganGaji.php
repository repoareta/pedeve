<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class GolonganGaji extends Model
{
    use CompositeKey;

    protected $table = "sdm_golgaji";
    protected $primaryKey = ['nopeg', 'tanggal', 'golgaji'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    const CREATED_AT = 'tglentry';
}
