<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PanjarHeader extends Model
{
    use SoftDeletes;

    protected $table = "panjar_header";
    protected $primaryKey = 'no_panjar'; // or null
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $dates = ['deleted_at'];
    
    /**
     * Panjar Header hasMany Panjar Detail
     *
     * @return void
     */
    public function panjar_detail()
    {
        return $this->hasMany('App\Models\PanjarDetail', 'no_panjar');
    }
}
