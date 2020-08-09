<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Admin;
use App\social; //sử dụng model Social
use Laravel\Socialite\Facades\Socialite; //sử dụng Socialite
use App\login; //sử dụng model Login
use Illuminate\Support\Facades\Validator;
session_start();

class Admin_Controller extends Controller
{
    public function Auth_login()
    {
        $admin_id = session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        } else {
            return redirect::to('admin')->send();
        }
    }
    public function show_dashboard()
    {
        $this->auth_login();
        return view('admin_layout');
    }
    public function admin()
    {
        return view('admin.admin');
    }
    public function admin_login(Request $request)
    {
//       $data = $request->validate([
//            'admin_email' => 'required',
//            'admin_password' => 'required',
//            'g-recaptcha-response' => new Captcha(), 		//dòng kiểm tra Captcha
//        ]);
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
//
        $result = Admin::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
            session::put('admin_id',$result->admin_id);
            session::put('admin_name',$result->admin_name);
            Cookie::get('admin_id',$result->admin_id);
            return redirect::to('/dashboard');
        } else{
            session::put('message','Email or password is not correct');
            return redirect::to('/admin');
        }
    }
    public function logout()
    {
        session::put('admin_id',NULL);
        session::put('admin_name',NULL);
        return redirect::to('/admin');
    }
    //login-facebook
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('admin_id',$account->user)->first();

            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
    }
    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user();
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');


    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }

        $hieu = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Login::where('admin_email',$users->email)->first();

        if(!$orang){
            $orang = Login::create([
                'admin_name' => $users->name,
                'admin_email' => $users->email,
                'admin_password' => '',

            ]);
        }
        $hieu->login()->associate($orang);
        $hieu->save();

        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/dashboard');
    }

}
