<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashjudex extends Model
{
    public $timestamps = false;
    protected $table="cashjudex";
    protected $fillable=['kode','nama'];

    public function detailumk()
    {
        return $this->belongToMany('App\DetailUmk');
    }
}
