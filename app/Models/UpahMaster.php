<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpahMaster extends Model
{
    protected $table = "pay_master_upah";
    protected $primaryKey = ['tahun', 'bulan', 'nopek'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    public function pekerja()
    {
        return $this->belongsTo('App\Models\Pekerja', 'nopek');
    }

    public function aard_payroll()
    {
        return $this->belongsTo('App\Models\AardPayroll', 'aard');
    }
}
