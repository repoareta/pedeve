<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SdmKdbagModel extends Model
{
    public $timestamps = false;
    protected $table="sdm_tbl_kdbag";
    protected $fillable=['kode','nama'];
}
