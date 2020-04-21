<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class Seminar extends Model
{
    use CompositeKey;

    protected $table = "sdm_seminar";
    protected $primaryKey = ['nopeg', 'nama'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    const CREATED_AT = 'tglentry';
}
