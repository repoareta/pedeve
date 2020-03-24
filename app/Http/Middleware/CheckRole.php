<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$role)
    {
        if(in_array($request->user()->userlv,$role)){
            return $next($request);
        }
            return redirect('/login')->with('notif','*Tidak Terdaftar Sebagai User.');
    }

    public function getAuthPassword()
    {
        return $this->userpw;
    }

   
 
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return $user->getAuthPassword() === $credentials['userpwm'];
    }
}
