<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasline extends Model
{
    protected $table="kasline";
    protected $primaryKey = ['docno', 'lineno'];
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
}
