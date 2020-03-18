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
    public function panjar_detail()
    {
        return $this->belongsTo('App\Models\PanjarDetail', 'no_panjar');
    }
}
