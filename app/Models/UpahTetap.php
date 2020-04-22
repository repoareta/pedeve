<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class UpahTetap extends Model
{
    use CompositeKey;

    protected $table = "sdm_ut";
    protected $primaryKey = ['nopeg', 'ut'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    const CREATED_AT = 'tglentry';
}
