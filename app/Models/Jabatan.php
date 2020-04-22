<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class Jabatan extends Model
{
    use CompositeKey;
    
    protected $table = "sdm_jabatan";
    protected $primaryKey = ['nopeg', 'kdbag', 'kdjab'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    const CREATED_AT = 'tglentry';

    /**
     * Jabatan dimiliki KodeBagian
     *
     * @return void
     */
    public function kode_bagian()
    {
        return $this->belongsTo('App\Models\KodeBagian', 'kdbag');
    }

    public function kode_jabatan()
    {
        return $this->belongsTo('App\Models\KodeJabatan', 'kdjab', 'kdbag');
    }
}
