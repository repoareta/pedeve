<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanjarHeader extends Model
{
    protected $table = "panjar_header";
    public $timestamps = false;

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
