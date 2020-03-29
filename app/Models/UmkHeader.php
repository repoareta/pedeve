<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkHeader extends Model
{
    protected $table = "kerja_header";
    protected $primaryKey = 'no_umk'; // or null
    public $timestamps = false;
    public $incrementing = false;
}
