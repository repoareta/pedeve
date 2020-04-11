<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PUmkHeader extends Model
{
    protected $table = "pumk_header";
    protected $primaryKey = 'no_pumk'; // or null
    public $timestamps = false;
    public $incrementing = false;

    public function pumk_detail()
    {
        return $this->hasMany('App\Models\PUmkDetail', 'no_pumk');
    }
}
