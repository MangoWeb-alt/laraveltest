<?php

namespace App\Http\Controllers;
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Coupon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();

class Cart_Controller extends Controller
{
    public function Check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::Where('coupon_code',$data['coupon_code'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                Session::put('coupon');
                $session_coupon = Session::get('coupon');
                if($session_coupon){
                    $available = 0;
                    if($available == 0){
                        $count[] = array(
                          'coupon_code'=>$coupon->coupon_code,
                          'coupon_condition'=>$coupon->coupon_condition,
                          'coupon_number'=>$coupon->coupon_number
                        );
                        Session::put('coupon',$count);
                    }
                } else {
                    $count[] = array(
                        'coupon_code'=>$coupon->coupon_code,
                        'coupon_condition'=>$coupon->coupon_condition,
                        'coupon_number'=>$coupon->coupon_number
                    );
                    Session::put('coupon',$count);
                 }
                Session::save();
                return Redirect()->back()->with('message','Add Discount Code successfully');
            }
        } else {
            return Redirect()->back()->with('message','Code is wrong');
        }
    }
    public function unset_discount_code()
    {
        $cart = session::get('cart');
        if($cart){
            Session::forget('coupon');
            }
            return redirect::to('/show-cart-ajax');
    }
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = session::Get('cart');
        if($cart == true){
            $available = 0;
            foreach ($cart as $key=>$value){
                if($value['product_id'] == $data['cart_product_id']){
                    $available++;
                }
            }
            if($available == 0){
                $cart[] = array(
                    'session_id'=>$session_id,
                    'product_name'=>$data['cart_product_name'],
                    'product_id'=>$data['cart_product_id'],
                    'product_image'=>$data['cart_product_image'],
                    'product_qty'=>$data['cart_product_qty'],
                    'cart_product_quantity'=>$data['cart_product_quantity'],
                    'product_price'=>$data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        } else{
            $cart[] = array(
                'session_id'=>$session_id,
                'product_name'=>$data['cart_product_name'],
                'product_id'=>$data['cart_product_id'],
                'product_image'=>$data['cart_product_image'],
                'product_qty'=>$data['cart_product_qty'],
                'cart_product_quantity'=>$data['cart_product_quantity'],
                'product_price'=>$data['cart_product_price'],
            );
            Session::put('cart',$cart);
        }
        session::save();
    }
    public function show_cart_ajax(Request $request)
    {
        $slider = Banner::orderby('slider_id','DESC')->get();
        $meta_description = "Cart Ajax";
        $meta_keywords ="Cart Ajax" ;
        $meta_title ="My Cart Ajax" ;
        $url_canonical = $request->url();
        $category_product = DB::table('tbl_category')->orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->where('brand_status','2')->get();

        return view('Home.cart.cart_ajax')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
    public function delete_cart_ajax($session_id)
    {
        $cart = session::get('cart');
        if($cart){
            foreach($cart as $key=>$value){
                if($value['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            session::put('cart',$cart);
            return redirect::to('/show-cart-ajax');
        }
    }
    public function update_cart_ajax(Request $request)
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
        return redirect::to('/show-cart-ajax');

    }
    public function add_to_cart(Request $request)
    {
        $meta_description = "Cart";
        $meta_keywords ="Cart" ;
        $meta_title ="My Cart" ;
        $url_canonical = $request->url();

        $category_product = DB::table('tbl_category')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('Home.cart.add_to_cart')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function save_cart(Request $request)
    {
        $product_id = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::Table('tbl_product')->where('product_id',$product_id)->first();
        $data = array();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price']= $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
         Cart::add($data);
//         $content = Cart::content();
//         echo '<pre>';
//         print_r($content);
//         echo '</pre>';
        return redirect::to('/add-to-cart');
    }
    public function update_quantity(Request $request,$rowId)
    {
        $quantity = $request->qty;
        Cart::update($rowId,$quantity);
        return redirect::to('/add-to-cart');
    }
    public function delete_cart($rowId)
    {
        Cart::update($rowId,'0');
        session::flush();
        return redirect::to('/add-to-cart');
    }

}
