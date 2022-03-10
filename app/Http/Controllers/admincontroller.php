<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Session;
use Auth;

class admincontroller extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function loginform(){
        return view('backend.login');

    }
    public function dashboardform( Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',

        ]);
        if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=> $request->password])) {
            return view('backend.index');
        } else {
            Session::flash('error_message', 'Invalid email of password');
            return redirect()->back();
        }
    }
}
