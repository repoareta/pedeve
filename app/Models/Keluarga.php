<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class Keluarga extends Model
{
    use CompositeKey;

    protected $table = "sdm_keluarga";
    protected $primaryKey = ['nopeg', 'status', 'nama'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    const CREATED_AT = 'tglentry';

    /**
     * Kode Jabatan dimiliki Kode Bagian
     *
     * @return void
     */
    public function kode_agama()
    {
        return $this->belongsTo('App\Models\Agama', 'agama', 'kode');
    }
}
