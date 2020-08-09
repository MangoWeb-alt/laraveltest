@extends('welcome')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/trang-chu')}}}">Home</a></li>
                    <li class="active">Payment</li>
                </ol>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="image">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    @foreach($content as $key=>$v_content)--}}
                    {{--                    @endforeach--}}
                    <?php
                    $cart = Session::get('cart');
                    ?>
                    <?php
                    $total = 0;
                    $tax = 0;
                    $grandSubTotal = 0;
                    ?>
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
                                        <input class="cart_quantity_input" type="text" min="1" name="cart_qty[{{$value['session_id']}}]" value="{{$value['product_qty']}}" autocomplete="off" size="5">
                                        <input type="submit" name="update_qty" class="btn btn-success" value="Update">
                                    </div>
                                </td>
                            </form>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($subtotal,0,',','.')}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{URL::to('delete-cart-ajax/'.$value['session_id'])}}" onclick="return confirm('Are you want to delete?')"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="total_area">
                <ul>
                    <li>Cart Sub Total <span>{{number_format($total,0,',','.')}}</span></li>
                    <li>Eco Tax <span>{{number_format($tax,0,',','.')}}</span></li>
                    <li>Shipping Cost <span>Free</span></li>
                    <li>Total <span>{{number_format($grandSubTotal,0,',','.')}}</span></li>
                </ul>
            </div>
            <br><br><br>
            <form action="{{URL::to('/order-place')}}" method="post">
                {{csrf_field()}}
                <div class="payment-options">
					<span>
						<label><input name="payment_method" type="radio" value="1"> Direct Bank Transfer</label>
					</span>
                    <span>
						<label><input type="radio" name="payment_method" value="2"> Check Payment</label>
					</span>
                    <span>
						<label><input type="radio" name="payment_method" value="3"> PayPal</label>
					</span>
                    <input type="submit" name="send_order" value="Send" class="btn btn-success btn-sm">
                </div>
            </form>
        </div>
    </section> <!--/#cart_items-->

@endsection
