<?php

namespace App\Http\Controllers;
use App\Banner;
use App\City;
use App\Feeship;
use App\Order;
use App\OrderDetails;
use App\Province;
use App\Shipping;
use App\wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class Checkout_Controller extends Controller
{
    public function select_delivery_checkout(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            if ($data['action'] == 'city') {
                $select_province = Province::WHERE('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                echo '<option>Select Province</option>';
                foreach ($select_province as $key => $value_province) {
                    echo '<option value="' . $value_province->maqh . '">' . $value_province->name_qh . '</option>';
                }
            } else if($data['action'] == "province"){
                $select_wards = wards::WHERE('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                echo '<option>Select Wards</option>';
                foreach ($select_wards as $key=>$wards){
                    echo '<option value="'.$wards->xaid.'">'.$wards->name_xa.'</option>';
                }
            }
        }
    }
    public function delivery_cost_checkout(Request $request)
    {
        $data = $request->all();
        if($data['matp']){
                 $delivery_cost = Feeship::WHERE('delivery_matp',$data['matp'])->WHERE('delivery_maqh',$data['maqh'])->WHERE('delivery_xaid',$data['xaid'])->first();
                 if($delivery_cost){
                     Session::put('fee',$delivery_cost->delivery_cost);
                     Session::save();
                 }
        } else {
            Session::put('fee',25000);
            Session::save();
        }
    }
    public function checkout(Request $request)
    {
        $slider = Banner::orderby('slider_id','DESC')->get();
        $meta_description = "";
        $meta_keywords ="" ;
        $meta_title ="" ;
        $url_canonical = $request->url();

        $city = City::orderby('matp','ASC')->get();
        $category_product = DB::table('tbl_category')->orderBy('category_id','desc')->where('category_status','2')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->where('brand_status','2')->get();
        return view('Home.checkout.checkout')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('slider',$slider);
    }
    public function save_checkout(Request $request)
    {
        $data = array();
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_description'] = $request->shipping_description;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        session::put('shipping_id',$shipping_id);
        return redirect::to('payment');
    }
    public function delete_cart_ajax_checkout($session_id)
    {
        $cart = session::get('cart');
        if($cart){
            foreach($cart as $key=>$value){
                if($value['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            session::put('cart',$cart);
            return redirect::to('/checkout');
        }
    }
    public function update_cart_ajax_checkout(Request $request)
    {
        $data = $request->all();
        $cart = session::get('cart');
        if($cart){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $value){
                    if($value['session_id'] == $key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
        }
        session::put('cart',$cart);
        return redirect::to('/checkout');
    }
    public function unset_discount_code_checkout()
    {
        $cart = session::get('cart');
        if($cart){
            Session::forget('coupon');
        }
        return redirect::to('/checkout');
    }
    public function confirm_order(Request $request)
    {
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name= $data['shipping_name'];
        $shipping->shipping_email= $data['shipping_email'];
        $shipping->shipping_phone= $data['shipping_phone'];
        $shipping->shipping_address= $data['shipping_address'];
        $shipping->shipping_notes= $data['shipping_notes'];
        $shipping->shipping_method= $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }
    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    }
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('delivery_matp',$data['matp'])->where('delivery_maqh',$data['maqh'])->where('delivery_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                    foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->delivery_cost);
                        Session::save();
                    }
                }else{
                    Session::put('fee',25000);
                    Session::save();
                }
            }

        }
    }

}
