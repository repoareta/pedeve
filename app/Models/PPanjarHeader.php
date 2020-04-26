<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PPanjarHeader extends Model
{
    use SoftDeletes;

    protected $table = "ppanjar_header";
    protected $primaryKey = 'no_ppanjar'; // or null
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    const CREATED_AT = 'tgl_ppanjar';
    
    protected $dates = ['deleted_at'];
}
