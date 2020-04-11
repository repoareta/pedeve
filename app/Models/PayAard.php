<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayAard extends Model
{
    protected $table = "pay_tbl_aard";
    protected $primaryKey = 'kode'; // or null
    public $timestamps = false;
    public $incrementing = false;
}
