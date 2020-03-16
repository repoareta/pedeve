<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashjudexModel extends Model
{
    public $timestamps = false;
    protected $table="cashjudex";
    protected $fillable=['kode','nama'];
}
