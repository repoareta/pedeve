<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewClassAccount extends Model
{
    protected $table = 'v_class_account';

    public function sub_class_account()
    {
        return $this->hasMany('App\Models\ViewSubClassAccount', 'urutan', 'urutan');
    }

    public function neraca()
    {
        return $this->hasMany('App\Models\ViewNeraca', 'sub_akun', 'batas_awal');
    }
}
