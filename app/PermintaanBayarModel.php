<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanBayarModel extends Model
{
    // protected $primaryKey = 'no_bayar';
    public $timestamps = false;
    protected $table="umu_bayar_header";

    public function umubayardetailmodel()
    {
        return $this->hasMany('App\UmuBayarDetailModel', 'no_bayar');
    }

}
