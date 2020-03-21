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
            	}elseif(Auth::user()->userlv == '2'){
                	return redirect()->route('isi_route pada Authcontroller');
            	}elseif(Auth::user()->userlv == '3'){
                	return redirect()->route('isi_route pada Authcontroller');
            	}elseif(Auth::user()->userlv == '4'){
                	return redirect()->route('isi_route pada Authcontroller');
            	}elseif(Auth::user()->userlv == '5'){
                	return redirect()->route('isi_route pada Authcontroller');
                }else {
                    return redirect('/login')->with('notif','*Username atau Password salah.');
                }
            }else{
                return redirect('/login')->with('notif','*Username atau Password salah.');
            }
        
    }

	public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}