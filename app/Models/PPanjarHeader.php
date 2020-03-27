<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPanjarHeader extends Model
{
    protected $table = "ppanjar_header";
    protected $primaryKey = 'no_ppanjar'; // or null
    public $timestamps = false;
    public $incrementing = false;
}
