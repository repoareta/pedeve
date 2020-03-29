<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function postlogin(Request $Request){

            if(Auth::attempt($Request->only('usernm','userpw'))){
            	if(Auth::user()->userlv == '1'){
                	return redirect()->route('perjalanan_dinas.index');
            	}else{
                    return redirect('/login')->with('notif','*Tidak Terdaftar Sebagai User.');
                }
            }else{
                return redirect('/login')->with('notif','*Username atau Password salah.');
            }
        
    }

    public function getAuthPassword()
    {
        return $this->userpw;
    }

   
 
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return $user->getAuthPassword() === $credentials['userpw'];
    }

	public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}