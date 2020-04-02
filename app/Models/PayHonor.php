<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayHonor extends Model
{
    protected $table = "pay_honorarium";
    protected $primaryKey = 'nopek'; // or null
    public $timestamps = false;
    public $incrementing = false;
}
