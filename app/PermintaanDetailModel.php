<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanDetailModel extends Model
{
    // protected $primaryKey = 'no_umk';
    public $timestamps = false;
    protected $table="umu_bayar_detail";

    public function umubayarmodel()
    {
        return $this->belongsTo('App\UmuBayarModel','no_bayar');
    }
}
