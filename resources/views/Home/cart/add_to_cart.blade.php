@extends('welcome')
@section('content')
   <?php  use Gloudemans\Shoppingcart\Facades\Cart; ?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <?php
                $content = Cart::content();
                ?>
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
                @foreach($content as $key=>$v_content)
                    <?php
                    $grandtotal = $v_content->price * $v_content->qty;
                    ?>
                <tr>
                    <td class="cart_product">
                        <a href=""><img src="{{URL::to('style/uploads/product/'.$v_content->options->image)}}" width="120" height="150" alt=""></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{$v_content->name}}</a></h4>
                    </td>
                    <td class="cart_price">
                        <p>{{number_format($v_content->price)}}VNĐ</p>
                    </td>
                    <form action="{{URL::to('/update-quantity/'.$v_content->rowId)}}" method="post">
                        {{csrf_field()}}
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <input class="cart_quantity_input" type="text" name="qty" value="{{$v_content->qty}}" autocomplete="off" size="2">
                            <input type="submit" name="update_qty" class="btn btn-success" value="Update">
                        </div>
                    </td>
                    </form>
                    <td class="cart_total">
                        <p class="cart_total_price">{{number_format($grandtotal)}}VNĐ</p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}" onclick="return confirm('Are you want to delete?')"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
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
                        <li>Cart Sub Total <span>{{Cart::subtotal()}} VNĐ</span></li>
                        <li>Eco Tax <span>{{Cart::tax()}} VNĐ</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>{{Cart::total()}} VNĐ</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection
