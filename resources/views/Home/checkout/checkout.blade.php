@extends('welcome')
@section('content')
    <?php use Illuminate\Support\Facades\Session?>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                    <li class="active">Thanh toán giỏ hàng</li>
                </ol>
            </div>

            <div class="register-req">
                <p>Please sign in or register to order and see your history order</p>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <div class="row">

                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Fill in the order place</p>
                            <div class="form-one">
                                <form method="POST">
                                    @csrf
                                    <input type="text" name="shipping_email" class="shipping_email" placeholder="Your email:...">
                                    <input type="text" name="shipping_name" class="shipping_name" placeholder="Your Full Name:...">
                                    <input type="text" name="shipping_address" class="shipping_address" placeholder="Address:...">
                                    <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Phone Number:...">
                                    <textarea name="shipping_notes" class="shipping_notes" placeholder="Notes your order:..." rows="5"></textarea>

                                    @if(Session::get('fee'))
                                        <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                                    @else
                                        <input type="hidden" name="order_fee" class="order_fee" value="10000">
                                    @endif

                                    @if(Session::get('coupon'))
                                        @foreach(Session::get('coupon') as $key => $cou)
                                            <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                    @endif

                                    <div class="">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Choose your payment method</label>
                                            <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
                                                <option value="0">By Credit Card</option>
                                                <option value="1">By Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if(Session::get('fee') == true)
                                    <form>
                                        <input type="button" value="Check your order" name="send_order" class="btn btn-primary btn-sm send_order">
                                    </form>
                                     @endif
                                    <br><br>
                                </form>
                                <form>
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Select City</label>
                                        <select name="city" id="city" class="form-control input-sm m-bot15 choose city">

                                            <option value="">Select City</option>
                                            @foreach($city as $key => $ci)
                                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Select Province</label>
                                        <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                            <option value="">Select Province</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Select Wards</label>
                                        <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                            <option value="">Select Wards</option>
                                        </select>
                                    </div>
                                    <input type="button" value="Calculate Delivery Cost" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
                                </form>

                            </div>

                        </div>
                    </div>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                            <tr class="cart_menu">
                                <td class="image">Image</td>
                                <td class="description">Name</td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cart = Session::get('cart');
                            ?>
                            <?php
                            $fee = Session::get('fee');
                            $total = 0;
                            $tax = 0;
                            $grandSubTotal = 0;
                            ?>
                            @if($cart == true)
                            @foreach($cart as $key => $value)
                                <?php
                                $subtotal = $value['product_qty'] * $value['product_price'];
                                $total = $subtotal + $total;
                                $tax = $total * 0.1;
                                $grandSubTotal = $total + $tax;
                                ?>
                                <tr>
                                    <td class="cart_product">
                                        <a href=""><img src="{{asset('style/uploads/product/'.$value['product_image'])}}" width="120" height="150" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href=""></a>{{$value['product_name']}}</h4>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{number_format($value['product_price'],0,',','.')}} VNĐ</p>
                                    </td>
                                    <form action="{{URL::to('/update-cart-ajax-checkout')}}" method="post">
                                        {{csrf_field()}}
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <input class="cart_quantity_input" type="text" min="1" name="cart_qty[{{$value['session_id']}}]" value="{{$value['product_qty']}}" autocomplete="off" size="5">
                                                <input type="submit" name="update_qty" class="btn btn-success" value="Update">
                                            </div>
                                        </td>
                                    </form>
                                        <td class="cart_total">
                                            <p class="cart_total_price">{{number_format($subtotal,0,',','.')}} VNĐ</p>
                                        </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{URL::to('delete-cart-ajax-checkout/'.$value['session_id'])}}" onclick="return confirm('Are you want to delete?')"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                            @else
                                <?php
                                echo "<h1 style='font-weight: 500;font-size: 35px;text-align: center;color: red'>Please go back to cart to buy more stuffs</h1>";
                                ?>
                            @endif
                        </table>
                    </div>
                </div>
    </section> <!--/#cart_items-->
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose everything you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>{{number_format($total,0,',','.')}} VNĐ</span></li>
                            <li>Eco Tax <span>{{number_format($tax,0,',','.')}} VNĐ</span></li>
                            <li>Shipping Cost <span>{{number_format($fee,0,'.',',')}} VNĐ
                             @if(isset($fee))
                                      <a class="cart_quantity_delete" href="{{url('/del-fee')}}" onclick="return confirm('Are you want to delete?')"><i class="fa fa-times"></i></a></span></li>
                                @endif
                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key=>$count)
                                    @if($count['coupon_condition'] == 1)
                                        <li>Discount <span>{{$count['coupon_number']}} %</span></li>
                                        @php
                                            $total_coupon = $grandSubTotal - ($grandSubTotal* $count['coupon_number'])/100 ;
                                        @endphp
                                    @else
                                        <li>Discount <span>{{number_format($count['coupon_number'],0,',','.')}} VNĐ</span></li>
                                        @php
                                            $total_coupon = $grandSubTotal - $count['coupon_number'];
                                        @endphp
                                    @endif
                                @endforeach
                            @endif
                            @if(Session::get('coupon'))
                                <li>Total <span>{{number_format($total_coupon+$fee,0,',','.')}} VNĐ</span></li>
                            @else
                                <li>Total <span>{{number_format($grandSubTotal+$fee,0,',','.')}} VNĐ</span></li>
                            @endif
                        </ul>
                        <br>
                        <form method="post" action="{{URL::to('/check-coupon')}}">
                            {{csrf_field()}}
                            <input type="text" class="form-control" name="coupon_code" placeholder="ENTER YOUR DISCOUNT CODE:...">
                            <input type="submit" class="btn btn-success check_coupon" value="Discount Code">
                        </form>
                        @if(Session::get('coupon') && Session::get('customer_id'))
                            <td class="cart_delete">
                                <a class="btn btn-default check_out" class="cart_quantity_delete" href="{{URL::to('unset-discount-code-checkout')}}" onclick="return confirm('Are you want to unset ?')">Unset Discount Code</a>
                            </td>
                        @elseif(empty(Session::get('customer_id')))
                            <td class="cart_delete">
                                <a class="btn btn-default check_out" class="cart_quantity_delete" href="{{URL::to('login-checkout')}}" onclick="return confirm('Are you want to unset ?')">Unset Discount Code</a>
                            </td>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section><!--/#do_action-->
@endsection
