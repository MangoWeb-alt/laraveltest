<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Order;
use App\OrderDetails;
use App\Customers;
use App\Product;
use App\Shipping;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class Order_Controller extends Controller
{
    public function update_quantity_order(Request $request)
    {
        $data = $request->all();
        $order_details = OrderDetails::WHERE('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_quantity'];
        $order_details->save();
    }
    public function update_order_quantity(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
         $order->save();
         if($order->order_status==2){
         foreach($data['order_product_id'] as $key => $product_id){
             $product = Product::find($product_id);
             $product_quantity = $product->product_quantity;
             $product_sold = $product->product_sold;
             foreach($data['quantity'] as $key2 => $quantity){
                 if($key == $key2){
                     $pro_remain = $product_quantity - $quantity;
                     $product->product_quantity = $pro_remain;
                     $product->product_sold = $product_sold + $quantity;
                     $product->Save();
                 }
              }
           }
        }  elseif($order->order_status!=2 && $order->order_status!=3){
             foreach($data['order_product_id'] as $key => $product_id){
                 $product = Product::find($product_id);
                 $product_quantity = $product->product_quantity;
                 $product_sold = $product->product_sold;
                 foreach($data['quantity'] as $key2 => $quantity){
                     if($key==$key2){
                         $pro_remain = $product_quantity + $quantity;
                         $product->product_quantity = $pro_remain;
                         $product->product_sold = $product_sold - $quantity;
                         $product->Save();
                     }
                 }
             }
         }
     }
    public function print_order($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code)
    {
        $order = Order::where('order_code',$checkout_code)->get();
        foreach($order as $key=>$ord){
            $customer_id =$ord->customer_id;
            $shipping_id =$ord->shipping_id;
        }
        $customer = Customers::Where('customer_id',$customer_id)->get();
        $shipping = Shipping::WHERE('shipping_id',$shipping_id)->get();
        $order_details = OrderDetails::with('product')->where('order_code',$checkout_code)->get();
        foreach($order_details as $key=>$value){
            $coupon = Coupon::WHERE('coupon_code',$value->product_coupon)->get();
        }
        $output = '';
        $output .= '<style>
             body{
             font-family: DejaVu Sans;
             font-size: 13px;
             }
             .table-striped {
             border: 1px solid #000;
             }
             .table-striped tbody tr td{
             border: 1px solid #000;
             }

     </style>';
       $output .= '<h1 style="font-size: 35px;text-transform: uppercase;font-weight: 400">Shop bán hàng uy tín và giá rẻ!!! </h1>';

        $output .= '<h3 style="font-size: 25px;text-transform: uppercase;font-weight: 400">Customer Details </h3>';
        $output .= '<table class="table table-striped table-bordered">
            <thead>
                    <tr>
                         <th>CustomerName</th>
                         <th>Phone</th>
                         <th>Email</th>
                    </tr>
            </thead>
            <tbody>';
        foreach($customer as $key=> $customer_value){
        $output .= '
                   <tr>
                        <td>'.$customer_value->customer_name.'</td>
                        <td>'.$customer_value->customer_phone.'</td>
                        <td>'.$customer_value->customer_email.'</td>
                   </tr>';
                   }
        $output .='
            </tbody>
</table>';

        $output .= '<h3 style="font-size: 25px;text-transform: uppercase;font-weight: 400">Shipping Details </h3>';
        $output .= '<table class="table table-striped table-bordered">
            <thead>
                    <tr>
                         <th>ShippingName</th>
                         <th>Email</th>
                         <th>Address</th>
                         <th>Phone</th>
                         <th>Notes</th>
                         <th>Method</th>
                    </tr>
            </thead>
            <tbody>';
        foreach($shipping as $key=> $shipping_value){
            $output .= '
                   <tr>
                        <td>'.$shipping_value->shipping_name.'</td>
                        <td>'.$shipping_value->shipping_email.'</td>
                        <td>'.$shipping_value->shipping_address.'</td>
                        <td>'.$shipping_value->shipping_phone.'</td>
                        <td>'.$shipping_value->shipping_notes.'</td>';
            if($shipping_value->shipping_method == 0) {
                $output .= '
                         <td>Credit Card</td>';
            } else {
                $output .= '
                         <td>Cash</td>';
            }
            $output .='
                   </tr>';
                    }
        $output .='
            </tbody>
</table>';

        $output .= '<h3 style="font-size: 25px;text-transform: uppercase;font-weight: 400">Order Details List </h3>';
        $output .= '<table class="table table-striped table-bordered">
            <thead>
                    <tr>
                         <th>ProductName</th>
                         <th>Quantity</th>
                         <th>CouponCode</th>
                         <th>Price</th>
                         <th>Subtotal</th>
                         <th>FeeShip</th>
                         <th>Total</th>
                    </tr>
            </thead>
            <tbody>';
        foreach($order_details as $key=> $order_value) {
            $total = 0;
            $subtotal = $order_value->product_sales_quantity * $order_value->product_price;
            $feeShip = $order_value->product_feeship;
            if ($order_value->product_coupon != 'no') {
                foreach ($coupon as $key2 => $coupon_value) {
                    if ($coupon_value->coupon_condition == 1) {
                        $total = ($subtotal + $feeShip) - ($subtotal * $coupon_value->coupon_number) / 100;
                    } elseif ($coupon_value->coupon_condition == 2) {
                        $total = $subtotal - $coupon_value->coupon_number + $feeShip;
                    }
                }
            } else {
                $total = $subtotal + $feeShip;
            }
            $output .= '
                   <tr>
                        <td>' . $order_value->product_name . '</td>
                        <td>' . $order_value->product_sales_quantity . '</td>
                        <td>' . $order_value->product_coupon . '</td>
                        <td>' . number_format($order_value->product_price) . ' VNĐ</td>
                        <td>' . number_format($subtotal) . ' VNĐ</td>
                        <td>' . number_format($order_value->product_feeship) . ' VNĐ</td>
                        <td>' . number_format($total) . ' VNĐ</td>
                   </tr>';
                     }
        $output .='
            </tbody>
</table>';
            $output .= '<table>
               <thead>
               <tr>
                <th width="200px">Người làm phiếu</th>
                 <th width="800px">Khách hàng</th>
          </tr>

              </thead>
        </table>';

        return $output;
    }
      public function manage_order()
   {

        $order = Order::orderby('created_at','DESC')->get();
        return view('admin.Order.manage_order')->with('order',$order);
   }
   public function view_order($order_code)
   {
       $order = Order::where('order_code',$order_code)->get();
       foreach($order as $key=>$ord){
       $customer_id =$ord->customer_id;
       $shipping_id =$ord->shipping_id;
       }
       $customer = Customers::Where('customer_id',$customer_id)->first();
       $shipping = Shipping::WHERE('shipping_id',$shipping_id)->first();
       $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
       foreach($order_details as $key=>$value){
       $coupon = Coupon::WHERE('coupon_code',$value->product_coupon)->get();
       }
       return view('admin.Order.view_order')->with('order_details',$order_details)->with('order',$order)->with('coupon',$coupon);
   }
}
