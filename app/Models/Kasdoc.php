<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasdoc extends Model
{
    protected $table = "kasdoc";
    protected $primaryKey = 'docno'; // or null
    public $timestamps = false;
    public $incrementing = false;

    public function storejk()
    {
        return $this->belongsTo(Storejk::class);
    }
}
