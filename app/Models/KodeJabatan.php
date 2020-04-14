<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class KodeJabatan extends Model
{
    use CompositeKey;
    
    protected $table = "sdm_tbl_kdjab";
    protected $primaryKey = ['kdbag', 'kdjab'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    /**
     * Kode Jabatan dimiliki Kode Bagian
     *
     * @return void
     */
    public function kode_bagian()
    {
        return $this->belongsTo('App\Models\KodeBagian', 'kdbag', 'kode');
    }
}
