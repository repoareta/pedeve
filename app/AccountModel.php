<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
    protected $primaryKey = "kodeacct";
    public $timestamps = false;
    protected $table="account";
    protected $fillable=['kodeacct','descacct','userid', 'update_date','flag','jenis'];

   public function detailumkmodel()
    {
        return $this->belongToMany('App\DetailUmkModel');
    }
}
