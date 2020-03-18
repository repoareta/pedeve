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
                	return redirect()->route('perjalanan_dinas.index');
            	}elseif(Auth::user()->kode == 'UMUM'){
                	return redirect()->route('perjalanan_dinas.index');
            	}else{
                	return redirect()->route('perjalanan_dinas.index');

                }
            }else{
                return redirect('/logina');
            }
        
    }

	public function logout(){
        Auth::logout();
        return redirect('/');
    }
}