<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GcgSosialisasi extends Model
{
    protected $table = "gcg_sosialisasi";

    public function pekerja()
    {
        return $this->belongsTo('App\Models\Pekerja', 'nopeg', 'nopeg');
    }
}
