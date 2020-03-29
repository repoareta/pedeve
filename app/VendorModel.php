<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorModel extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table="tbl_vendor";
}
