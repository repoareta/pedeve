<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanjarDetail extends Model
{
    protected $table = "panjar_detail";
    public $timestamps = false;

    /**
     * Panjar Detail dimiliki Panjar Header
     *
     * @return void
     */
    public function panjar_header()
    {
        return $this->belongsTo('App\Models\PanjarHeader', 'no_panjar');
    }
}
