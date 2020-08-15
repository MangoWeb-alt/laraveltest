@extends('welcome')
@section('content')
    <?php use Illuminate\Support\Facades\Session?>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <?php
            $message = Session::get('message');
            if($message){
                echo '<p style="color: green;font-size: 20px;text-align: center;">'.$message.'</p>';
                Session::put('message',NULL);
            }
            ?>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                    </tr>
                    </thead>
                    <tbody>
{{--                    @foreach($content as $key=>$v_content)--}}
{{--                    @endforeach--}}
                                 @php
                               $cart = Session::get('cart');
                                  @endphp
                      <?php
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
                            <form action="{{URL::to('/update-cart-ajax')}}" method="post">
                                {{csrf_field()}}
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <?php
                                        if($value['product_qty']<=$value['cart_product_quantity']){
                                        ?>
                                        <input class="cart_quantity_input" type="text" min="1" name="cart_qty[{{$value['session_id']}}]" value="{{$value['product_qty']}}" autocomplete="off" size="5">
                                            <?php
                                            }else{
                                            echo("<span style='font-size: 15px;color: red;'>Please buy no more than ".$value['cart_product_quantity']."</span>");
                                            ?>

                                            <input class="cart_quantity_input" type="text" min="1" name="cart_qty[{{$value['session_id']}}]" value="{{$value['cart_product_quantity']}}" autocomplete="off" size="5">
                                            <?php
                                            }
                                            ?>
                                        <input type="submit" name="update_qty" class="btn btn-success" value="Update">
                                    </div>
                                </td>
                            </form>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($subtotal,0,',','.')}} VNĐ</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{URL::to('delete-cart-ajax/'.$value['session_id'])}}" onclick="return confirm('Are you want to delete?')"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    @else
                        <?php
                        echo "<h1 style='font-weight: 500;font-size: 35px;text-align: center;color: red'>Please buy more stuffs</h1>";
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
                           @if(Session::get('coupon'))
                               @foreach(Session::get('coupon') as $key=>$count)
                                 @if($count['coupon_condition'] == 1)
                                        <li>Discount <span>{{$count['coupon_number']}} %</span></li>
                                         @php
                                        $total_coupon = $grandSubTotal - ($grandSubTotal* $count['coupon_number'])/100;
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
                            <li>Total <span>{{number_format($total_coupon,0,',','.')}} VNĐ</span></li>
                            @else
                                <li>Total <span>{{number_format($grandSubTotal,0,',','.')}} VNĐ</span></li>
                                @endif
                        </ul>
                        <br>
                        <form method="post" action="{{URL::to('/check-coupon')}}">
                            {{csrf_field()}}
                        <input type="text" class="form-control" name="coupon_code" placeholder="ENTER YOUR DISCOUNT CODE:...">
                        <input type="submit" class="btn btn-success check_coupon" value="Discount Code">
                        </form>
                        @if(Session::get('customer_id'))
                        <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Check Out</a>
                        @else
                         <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Check Out</a>
                        @endif

                        @if(Session::get('coupon') && Session::get('customer_id'))
                        <td class="cart_delete">
                            <a class="btn btn-default check_out" class="cart_quantity_delete" href="{{URL::to('unset-discount-code')}}" onclick="return confirm('Are you want to unset ?')">Unset Discount Code</a>
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
