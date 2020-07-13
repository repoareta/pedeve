<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Userpdv extends Model
{
    use SoftDeletes;

    protected $table="userpdv";

    protected $primaryKey = 'userid';
    public $incrementing = false;
    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function jabatan_latest()
    {
        return $this->hasMany('App\Models\Jabatan', 'nopeg')->latest()->first();
    }
}
