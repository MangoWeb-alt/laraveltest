<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();
class Payment_Controller extends Controller
{
    public function payment(Request $request)
    {
        $meta_description = "Payment";
        $meta_keywords ="Payment" ;
        $meta_title ="Payment" ;
        $url_canonical = $request->url();

        $category_product = DB::table('tbl_category')->orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->where('brand_status','2')->get();
        return view('Home.payment.payment')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function success(Request $request)
    {
        $meta_description = "Success";
        $meta_keywords ="Success" ;
        $meta_title ="Success" ;
        $url_canonical = $request->url();

        $category_product = DB::table('tbl_category')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('Home.payment.success')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function order_place(Request $request)
    {
        $cart = session::get('cart');
        $total = 0;
        foreach($cart as $key=>$value_cart){
            $subtotal = $value_cart['product_qty'] * $value_cart['product_price'];
            $total += $subtotal;
            $tax = $total * 0.1;
            $grandSubTotal = $total + $tax;
        }
        $data = array();
        $data['payment_method'] = $request->payment_method;
        $data['payment_status'] = 'Pending';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        $order_data = array();
        $order_data['customer_id'] = session::get('customer_id');
        $order_data['shipping_id'] = session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = $grandSubTotal;
        $order_data['order_status'] = 'pending';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        foreach($cart as $key=>$v_content){

            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $v_content['product_id'];
            $order_details_data['product_name'] = $v_content['product_name'];
            $order_details_data['product_price'] = $v_content['product_price'];
            $order_details_data['product_sales_quantity'] = $v_content['product_qty'];
        DB::table('tbl_order_details')->insert($order_details_data);
        }
        return redirect::to('/success');
    }
}
