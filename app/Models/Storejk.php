<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storejk extends Model
{
    protected $table="storejk";
    protected $primaryKey = 'kodestore';
    public $incrementing = false;
    public $timestamps = false;

    public function kasdoc()
    {
        return $this->hasMany(Kasdoc::class);
    }
}
