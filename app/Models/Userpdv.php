<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Userpdv extends Model
{
    use SoftDeletes;

    protected $table="userpdv";

    protected $primaryKey = 'userid';
    protected $keyType    = 'string';
    public $incrementing = false;
    public $timestamps   = false;

    protected $dates = ['deleted_at'];

    public function jabatan_latest()
    {
        return $this->hasMany('App\Models\Jabatan', 'nopeg')->latest()->first();
    }

    public function fungsi()
    {
        return $this->belongsTo('App\Models\GcgFungsi', 'gcg_fungsi_id', 'id');
    }

    public function fungsi_jabatan()
    {
        return $this->belongsTo('App\Models\GcgJabatan', 'gcg_jabatan_id', 'id');
    }

    public function pekerja()
    {
        return $this->belongsTo('App\Models\Pekerja', 'nopeg', 'nopeg');
    }
}
