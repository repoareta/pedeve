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
            	if(Auth::user()->kode == 'admin'){
                	return redirect('/umum/perjalanan_dinas');
            	}elseif(Auth::user()->kode == 'UMUM'){
                	return redirect('/umum/perjalanan_dinas');
            	}
            }else{
                return redirect('/login');
            }
        
    }

	public function logout(){
        Auth::logout();
        return redirect('/');
    }
}