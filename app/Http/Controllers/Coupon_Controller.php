<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite; //sử dụng Socialite
use App\Coupon;
use Illuminate\Support\Facades\Validator;
session_start();

class Coupon_Controller extends Controller
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
    public function insert_coupon()
    {
        $this->Auth_login();
        return view('admin.Coupon.insert_coupon');
    }
    public function add_coupon(Request $request)
    {
        $this->Auth_login();
        $data = $request->all();

        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->save();
        return Redirect::to('/coupon-list');
    }
    public function coupon_list()
    {
        $this->Auth_login();
        $coupon_list = Coupon::orderby('coupon_id','desc')->get();
        return view('admin.Coupon.coupon_list')->with('coupon_list',$coupon_list);
    }
    public function delete_coupon($coupon_id)
    {
        $this->Auth_login();
        Coupon::where('coupon_id',$coupon_id)->delete();
        return Redirect::to('/coupon-list');
    }
}
