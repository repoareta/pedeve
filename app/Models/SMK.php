<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class SMK extends Model
{
    use CompositeKey;

    protected $table = "sdm_smk";
    protected $primaryKey = ['nopeg', 'tahun'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    const CREATED_AT = 'tglentry';
}
