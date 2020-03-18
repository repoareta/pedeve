<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UmuBayarDetailModel extends Model
{
    // protected $primaryKey = 'no_umk';
    public $timestamps = false;
    protected $table="umu_bayar_detail";
    protected $fillable=['no','no_bayar','keterangan', 'account','nilai','cj','bagian','jb','pk'];

    public function umubayarmodel()
    {
        return $this->belongTo('App\UmuBayarModel');
    }
}
