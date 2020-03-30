<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanDetail extends Model
{
    // protected $primaryKey = 'no_bayar';
    public $timestamps = false;
    public $incrementing = false;
    protected $table="umu_bayar_detail";

    public function permintaanbayar()
    {
        return $this->belongsTo(PermintaanBayar::class);
    }
}
