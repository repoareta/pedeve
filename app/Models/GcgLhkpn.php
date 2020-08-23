<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GcgLhkpn extends Model
{
    protected $table = "gcg_lhkpn";

    public function pekerja()
    {
        return $this->belongsTo('App\Models\Pekerja', 'nopeg', 'nopeg');
    }
}
