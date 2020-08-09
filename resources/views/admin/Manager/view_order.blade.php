@extends('admin_layout')
@section('content')
    <?php use Gloudemans\Shoppingcart\Facades\Cart?>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Customer Details
            </div>
            <div class="table-responsive">
                @foreach($view_order as $key=>$order_by)
                    <table class="table table-striped b-t b-light">
                        <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>CustomerName</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th style="width:30px; "></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$order_by->customer_name}}</td>
                            <td>{{$order_by->customer_email}}</td>
                            <td>{{$order_by->customer_phone}}</td>
                        </tr>
                        </tbody>
                    </table><br>

            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div><br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Shipping Details
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$order_by->shipping_address}}</td>
                        <td>{{$order_by->shipping_phone}}</td>
                    </tr>
                    </tbody>
                </table><br>

            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <br><br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Order Details List
            </div>
            <div class="row w3-res-tb">

                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">


                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>ProductName</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>PaymentMethod</th>
                        <th style="width:30px; "></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$order_by->product_name}}</td>
                        <td>{{$order_by->product_sales_quantity}}</td>
                        <td>{{number_format($order_by->product_price)}}</td>
                        <td>{{$order_by->order_total}}</td>
                        <td><span class="text-ellipsis">
                            <?php
                                if($order_by->payment_method == 1){
                                    echo 'direct_bank_transfer';
                                }else if($order_by->payment_method == 2){
                                    echo 'check_payment';
                                }else {
                                    echo 'PayPal';
                                }
                                ?>
                            </span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @endforeach
@endsection
