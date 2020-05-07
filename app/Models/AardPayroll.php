<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AardPayroll extends Model
{
    protected $table = "pay_tbl_aard";
    protected $primaryKey = 'kode';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
}
