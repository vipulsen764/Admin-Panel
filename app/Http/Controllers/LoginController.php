<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Emplyoee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    public function adminlogin()
    {
        if(session()->has('user')){
            return redirect()->route('companies');

        }
       return view('admin.adminlogin');
    }

    public function checklogin(Request $request)
    {
        $check = User::where($request->email)->first();
        if(isset($check)){
            session()->put('user', $check->id);
            session()->put('username', $check->name);
            return redirect()->route('companies');
        }else {
            return redirect()->back()->with('error','User not found');
        }
    }

    public function logout(Request $request)
    {
        if(!empty(session()->has('user')) || !empty(session()->has('username')) ){
            // session()->forget('user');
            // session()->forget('username');
            // session()->forget(['user', 'username']);
            session()->flush();
            // echo session()->forget('user');die;
            return redirect()->route('loginform');
        } 
    
    }
}
