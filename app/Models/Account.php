<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $primaryKey = "kodeacct";
    public $timestamps = false;
    protected $table="account";
    protected $fillable=['kodeacct','descacct','userid', 'update_date','flag','jenis'];

   public function detailumk()
    {
        return $this->belongToMany('App\DetailUmk');
    }
}
