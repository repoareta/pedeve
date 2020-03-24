<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "userid";
    protected $table      = "userpdv";
    protected $fillable   = [
        'userid',
        'usernm',
        'userlv',
        'userap',
        'userpw',
        'tglupl',
        'usrpd',
        'kode',
        'passexp',
        'host'
    ];

}
