<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class HutangMaster extends Model
{
    use CompositeKey;
    
    protected $table = "pay_master_hutang";
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
