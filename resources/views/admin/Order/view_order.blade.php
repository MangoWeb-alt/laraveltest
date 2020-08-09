@extends('admin_layout')
@section('content')
    <?php use Illuminate\Support\Facades\Session?>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Customer Details
            </div>
            <div class="table-responsive">
                @foreach($order as $key=>$order_by)
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
                            <td>{{$order_by->customer->customer_name}}</td>
                            <td>{{$order_by->customer->customer_email}}</td>
                            <td>{{$order_by->customer->customer_phone}}</td>
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
                        <th>Email</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Notes</th>
                        <th>Method</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$order_by->shipping->shipping_email}}</td>
                        <td>{{$order_by->shipping->shipping_name}}</td>
                        <td>{{$order_by->shipping->shipping_address}}</td>
                        <td>{{$order_by->shipping->shipping_phone}}</td>
                        <td>{{$order_by->shipping->shipping_notes}}</td>
                        <td>
                            @php
                            if($order_by->shipping->shipping_method == 0){
                                    echo 'Credit Card';
                            } else if($order_by->shipping->shipping_method == 1){
                                    echo 'Cash';
                            }
                            @endphp
                        </td>
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
                        <th>ProductQuantity</th>
                        <th>Quantity</th>
                        <th>Coupon Code</th>
                        <th>Price</th>
                        <th>SubTotal</th>
                        <th>FeeShip</th>
                        <th>Total</th>
                        <th style="width:30px; "></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_details as $key=>$order_value)
                            @php
                            $total = 0;
                            $subtotal = $order_value->product_sales_quantity * $order_value->product_price;
                            $feeShip = $order_value->product_feeship;
                            @endphp
                            @if($order_value->product_coupon !='no')
                            @foreach($coupon as $key=>$coupon_value)
                                @if($coupon_value->coupon_condition==1)
                                    @php
                                    $total = ($subtotal + $feeShip) - ($subtotal * $coupon_value->coupon_number)/100 ;
                                    @endphp
                                @elseif($coupon_value->coupon_condition==2)
                                    @php
                                    $total = $subtotal - $coupon_value->coupon_number + $feeShip;
                                    @endphp
                                @endif
                            @endforeach
                            @else
                                @php
                                    $total = $subtotal + $feeShip;
                                @endphp
                            @endif
                    <tr class="color_background_{{$order_value->product_id}}">
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$order_value->product_name}}</td>
                        <td>{{$order_value->product->product_quantity}}</td>
                        <td>
                            @foreach($order as $key=>$order_id)
                                @if($order_id->order_status == 2)
                                    <input type="number" disabled  class="order_quantity_{{$order_value->product_id}}" value="{{$order_value->product_sales_quantity}}" min="1" name="product_sales_quantity"/>
                                @else
                                    <input type="number" class="order_quantity_{{$order_value->product_id}}" value="{{$order_value->product_sales_quantity}}" min="1" name="product_sales_quantity"/>
                                @endif
                            @endforeach
                                 <input type="hidden" name="order_code" class="order_code" value="{{$order_value->order_code}}"/>

                                 <input type="hidden" name="order_quantity_storage" class="order_quantity_storage_{{$order_value->product_id}}" value="{{$order_value->product->product_quantity}}"/>

                                 <input type="hidden" name="order_product_id" class="order_product_id" value="{{$order_value->product_id}}"/>
                                    @foreach($order as $key=>$order_id)
                                                @if($order_id->order_status != 2)
                                 <button class="btn btn-success update_quantity_order" data-product_id="{{$order_value->product_id}}">Update</button>
                                                @endif
                                    @endforeach
                        </td>
                        <td>{{$order_value->product_coupon}}</td>
                        <td>{{number_format($order_value->product_price)}} VNĐ</td>
                        <td>{{number_format($subtotal)}} VNĐ</td>
                        <td>{{number_format($feeShip)}} VNĐ</td>
                        <td>{{number_format($total)}} VNĐ</td>
                    </tr>
              @endforeach
                     <tr>
                            @foreach($order as $key=>$order_id)
                                @if($order_id->order_status == 1)
                         <form>
                             @csrf
                                <td colspan="7">
                                             <select class="form-control order_details_status">
                                                   <option value="">---Select your method---</option>
                                                    <option data-id="{{$order_id->order_id}}" selected value="1">Pending</option>
                                                    <option data-id="{{$order_id->order_id}}" value="2">Done</option>
                                                    <option data-id="{{$order_id->order_id}}" value="3">Remove</option>
                                              </select>
                                </td>
                         </form>
                                    @elseif($order_id->order_status == 2)
                                 <form>
                                     @csrf
                                     <td colspan="7">
                                         <select class="form-control order_details_status">
                                             <option value="">---Select your method---</option>
                                             <option data-id="{{$order_id->order_id}}" value="1">Pending</option>
                                             <option data-id="{{$order_id->order_id}}" selected value="2">Done</option>
                                             <option data-id="{{$order_id->order_id}}" value="3">Remove</option>
                                         </select>
                                     </td>
                                 </form>
                                    @else
                                 <form>
                                     @csrf
                                     <td colspan="7">
                                         <select class="form-control order_details_status">
                                             <option value="">---Select your method---</option>
                                             <option data-id="{{$order_id->order_id}}" value="1">Pending</option>
                                             <option data-id="{{$order_id->order_id}}" value="2">Done</option>
                                             <option data-id="{{$order_id->order_id}}" selected value="3">Remove</option>
                                         </select>
                                     </td>
                                 </form>
                             @endif
                            @endforeach
                   </tr>
                    </tbody>
                </table>
                <a target="_blank" style="text-align: center;font-size: 40px;" href="{{URL::to('/print-order/'.$order_value->order_code)}}">Print Order</a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
