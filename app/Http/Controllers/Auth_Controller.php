<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Roles;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();
class Auth_Controller extends Controller
{
    public function register_auth()
    {
        return view('admin.Custom_auth.register');
    }
    public function register(Request $request)
    {
        $this->validation_register($request);
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return redirect::to('/register-auth')->with('message','Register successfully');
    }
    public function validation_register($request)
    {
        return $this->validate($request,[
            'admin_name' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255'
        ]);
    }
    public function validation_login($request)
    {
        return $this->validate($request,[
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255'
        ]);
    }
    public function login_auth()
    {
        return view('admin.Custom_auth.login_auth');
    }
    public function login(Request $request)
    {
        $this->validation_login($request);
        $data = $request->all();
        if(Auth::attempt(['admin_email' => $request->admin_email,'admin_password' => $request->admin_password])){
           return redirect::to('/dashboard');
      } else {
            return Redirect::to('/login-auth')->with('message','Login unsuccessfully');
        }
    }
    public function logout_auth(){
        Auth::logout();
        return Redirect::to('login-auth')->with('message','logout successfully');
    }
}
