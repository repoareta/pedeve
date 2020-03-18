<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailUmkModel extends Model
{
    public $timestamps = false;
    protected $table="kerja_detail";
    protected $fillable=['no','keterangan', 'account','nilai','cj','jb','bagian','pk','no_umk'];

    public function umkmodel()
    {
        return $this->belongTo('App\UmkModel');
    }

    public function accountmodel()
    {
        return $this->hasmany('App\AccountModel');
    }
    public function cashjudexmodel()
    {
        return $this->hasmany('App\CashjudexModel');
    }
    public function jenisbiayamodel()
    {
        return $this->belongTo('App\JenisBiayaModel');
    }
    public function sdmkdbagmodel()
    {
        return $this->belongTo('App\SdmKdbagModel');
    }
}
