<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UmuBayarModel extends Model
{
    // protected $primaryKey = 'no_umk';
    public $timestamps = false;
    protected $table="umu_bayar_header";
    protected $fillable=['no_bayar','kepala','dari', 'pemohon','menyetujui','tgl_bayar','app_sdm','app_sdm_oleh','app_sdm_tgl','app_pbd_oleh','app_pbd_tgl','no_kas','bulan_buku','keterangan','ci','app_pbd','rate','lampiran','mata_anggaran','mulai','sampai','debet_tgl','debet_no','debet_dari','rekyes','norek','namabank'];

    public function umubayardetailmodel()
    {
        return $this->hasMany('App\UmuBayarDetailModel');
    }

}
