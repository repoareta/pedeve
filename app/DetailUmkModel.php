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
        return $this->belongTo(UmkModel::class);
    }
}
