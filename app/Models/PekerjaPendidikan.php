<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class PekerjaPendidikan extends Model
{
    use CompositeKey;

    protected $table = "sdm_pendidikan";
    protected $primaryKey = ['nopeg', 'mulai'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    const CREATED_AT = 'tglentry';

    /**
     * Undocumented function
     *
     * @return void
     */
    public function perguruan_tinggi()
    {
        return $this->belongsTo('App\Models\PerguruanTinggi', 'kodept');
    }
}
