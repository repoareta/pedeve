<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanBayar extends Model
{
    // protected $primaryKey = 'no_bayar';
    public $incrementing = false;
    public $timestamps = false;
    protected $table="umu_bayar_header";

    public function permintaandetail()
    {
        return $this->hasMany(PermintaanDetail::class);
    }

}
