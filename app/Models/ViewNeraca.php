<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewNeraca extends Model
{
    protected $table = 'v_neraca';

    public function andet()
    {
        return $this->belongsTo('App\Models\ViewAndet', 'sandi', 'sandi');
    }
}
