<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanDetailModel extends Model
{
    // protected $primaryKey = 'no_bayar';
    public $timestamps = false;
    public $incrementing = false;
    protected $table="umu_bayar_detail";

    public function permintaanbayarmodel()
    {
        return $this->belongsTo(PermintaanBayarModel::class);
    }
}
