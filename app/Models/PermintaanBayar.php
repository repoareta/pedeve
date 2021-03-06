<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanBayar extends Model
{
    protected $table="umu_bayar_header";
    protected $primaryKey = 'no_bayar';
    public $incrementing = false;
    public $timestamps = false;

    public function permintaandetail()
    {
        return $this->hasMany('App\Models\PermintaanDetail', 'no_bayar');
    }

}
