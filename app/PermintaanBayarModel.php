<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanBayarModel extends Model
{
    // protected $primaryKey = 'no_bayar';
    public $incrementing = false;
    public $timestamps = false;
    protected $table="umu_bayar_header";

    public function permintaandetailmodel()
    {
        return $this->hasMany(PermintaanDetailModel::class);
    }

}
