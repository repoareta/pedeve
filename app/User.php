<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticableContract;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
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
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
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
        'host',
        'nopeg'
    ];

    public function getAuthPassword()
    {
        return $this->userpw;
    }

   
 
    // public function validateCredentials(UserContract $user, array $credentials)
    // {
    //     return $user->getAuthPassword() === $credentials['userpwm'];
    // }
}
