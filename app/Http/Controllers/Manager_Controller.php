<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class Manager_Controller extends Controller
{
   public function Auth_login()
   {
       $admin_id = Session::get('admin_id');
       if($admin_id){
           return Redirect::to('/dashboard');
       } else {
           return Redirect::to('admin');
       }
   }
    public function manage_order()
    {
        $this->Auth_login();
        $manage_order = DB::table('tbl_order')->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
            ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')->get();
        return view('admin.Manager.manager')->with('manage_order',$manage_order);
    }
    public function delete_order($order_id)
    {
        $this->Auth_login();
          DB::table('tbl_order')->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
            ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')->where('order_id',$order_id)->delete();
          return redirect::to('/manage-order');
    }
    public function view_order()
    {
        $this->view_order();
       $view_order =  DB::table('tbl_order')->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')
           ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
           ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
           ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')->get();
        return view('admin.Manager.view_order')->with('view_order',$view_order);
    }
}
