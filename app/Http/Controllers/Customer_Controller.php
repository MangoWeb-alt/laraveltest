<?php

namespace App\Http\Controllers;
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class Customer_Controller extends Controller
{
    public function login_checkout(Request $request)
    {
        $slider = Banner::orderby('slider_id','DESC')->get();
        $meta_description = "";
        $meta_keywords ="" ;
        $meta_title ="" ;
        $url_canonical = $request->url();
        $category_product = DB::table('tbl_category')->orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->where('brand_status','2')->get();
        return view('Home.customer_details.login-checkout')->with('category_product',$category_product)->with('brand_product',$brand_product)
            ->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
    public function save_checkout(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] =md5($request->customer_password);
        $data['customer_address'] = $request->customer_address;
        $data['customer_phone'] = $request->customer_phone;
       $customer_id=DB::table('tbl_customer')->insertgetid($data);
       session::put('customer_id',$customer_id);
        return redirect::to('/add-to-cart');
    }
    public function login_customer(Request $request)
    {
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);
     $result = DB::Table('tbl_customer')->where('customer_email',$customer_email)->where('customer_password',$customer_password)->first();
     $customer_id = $result->customer_id;
     session::put('customer_id',$customer_id);
     Cookie::get('customer_id',$customer_id);
     return redirect::to('/Home');
    }
    public function logout()
    {
        Session::flush();
        return redirect::to('/login-checkout');
    }
}
