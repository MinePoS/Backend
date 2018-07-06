<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function dd(){
    	$json_string = json_encode(Request("commands"));
    	die($json_string);
    }

    public function showChangePassword(){
        return view('admin.pages.account.changepassword');
    }
    

    public function doChangePassword(){
        if (Hash::check(\Request('current_password'), \Auth::user()->password)) {
                $new1 = \Request('new_password');
                $new2 = \Request('new_password_repeat');
                if($new1 == $new2){
                    $u = \Auth::user();
                    $u->password = \Hash::make($new1);
                    $u->save();
                    session()->flash('good', 'Password Changed!');
                    return redirect()->route('admin.account.changepassword');
                }else{
                     session()->flash('bad', 'Passwords did not match');
            return redirect()->route('admin.account.changepassword');
                }
        }else{
            session()->flash('bad', 'Incorrect password');
            return redirect()->route('admin.account.changepassword');
        }
        

        return view('admin.pages.account.changepassword');
    }

    
}
