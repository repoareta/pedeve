<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umk extends Model
{
    protected $primaryKey = 'no_umk';
    public $incrementing = false;
    public $timestamps = false;
    protected $table="kerja_header";
    protected $fillable=['tgl_panjar','app_sdm','app_sdm_oleh', 'app_sdm_tgl','app_pbd_oleh','app_pbd_tgl','no_kas','bulan_buku','keterangan','ci','app_pbd','rate','jenis_um','no_umk','jumlah'];

    public function detailumk()
    {
        return $this->hasMany('App\DetailUmk');
    }
}
