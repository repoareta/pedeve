<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggaranSubMain extends Model
{
    protected $table = "anggaran_submain";
    protected $primaryKey = 'kode_submain'; // or null
    public $timestamps = false;
    public $incrementing = false;

    public function anggaran_detail()
    {
        return $this->hasMany('App\Models\AnggaranDetail', 'kode_submain');
    }
}
