<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GcgGratifikasi extends Model
{
    protected $table = "gcg_gratifikasi";

    public function pekerja()
    {
        return $this->belongsTo('App\Models\Pekerja', 'nopeg');
    }
}
