<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBiayaModel extends Model
{
    public $timestamps = false;
    protected $table="jenisbiaya";
    protected $fillable=['kode','keterangan','kode_sub','nilai','nilai_real','inputdate','inputuser'];

    public function detailumkmodel()
    {
        return $this->hasMany('App\DetailUmkModel');
    }
}
