@extends('admin_layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Category
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                            </label>
                        </th>
                        <th>Coupon Name</th>
                        <th>Coupon Time</th>
                        <th>Coupon Code</th>
                        <th>Coupon Number</th>
                        <th>Coupon Condition</th>
                        <th>Action</th>
                        <th style="width:30px; "></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupon_list as $key=>$show_coupon)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$show_coupon->coupon_name}}</td>
                            <td>{{$show_coupon->coupon_time}}</td>
                            <td>{{$show_coupon->coupon_code}}</td>
                            <?php if($show_coupon->coupon_condition == 1){
                            ?>
                            <td>{{number_format($show_coupon->coupon_number)}} %</td>
                            <?php
                            } else {
                            ?>
                            <td>{{number_format($show_coupon->coupon_number)}} VNĐ</td>
                            <?php
                            }
                            ?>

                            <td><span class="text-ellipsis">
                           <?php
                                    if($show_coupon->coupon_condition == 1){
                                    ?>
                             <label>Discount by % </label>
                           <?php
                                    } else {
                                    ?>
                                <label>Discount by cash</label>
                               <?php
                                    }
                                    ?>
                            </span></td>
                            <td>
                                <a href="{{URL::to('delete-coupon/'.$show_coupon->coupon_id)}}"class="active"  style="font-size: 15px;color:red" onclick="return confirm('Are you want to delete?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
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
@endsection

