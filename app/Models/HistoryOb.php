<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryOb extends Model
{
    protected $table = "history_ob";
    protected $primaryKey = null; // or null
    public $timestamps = false;
    public $incrementing = false;
}
