<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SdmKdbag extends Model
{
    public $timestamps = false;
    protected $table="sdm_tbl_kdbag";
    protected $fillable=['kode','nama'];

    public function detailumk()
    {
        return $this->hasMany('App\DetailUmk');
    }
}
