@extends('admin_layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                All product
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
                        <th>ProductName</th>
                        <th>CategoryName</th>
                        <th>BrandName</th>
                        <th>Description</th>
                        <th>Content</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th style="width:30px; "></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_product as $key=>$all_pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$all_pro->product_name}}</td>
                            <td>{{$all_pro->category_name}}</td>
                            <td>{{$all_pro->brand_name}}</td>
                            <td>{{$all_pro->product_description}}</td>
                            <td>{{$all_pro->product_content}}</td>
                            <td>{{number_format($all_pro->product_price)}} VNĐ</td>
                            <td>{{number_format($all_pro->product_quantity)}} </td>
                            <td><img src="{{('style/uploads/product/'.$all_pro->product_image)}}" width="120" height="100"></td>
                            <td><span class="text-ellipsis">
                           <?php
                                    if($all_pro->product_status == 1){
                                    ?>
                              <a href="{{URL::to('non-active-product/'.$all_pro->product_id)}}" style="font-size: 30px;color:red">Off</a>
                           <?php
                                    } else {
                                    ?>
                               <a href="{{URL::to('active-product/'.$all_pro->product_id)}}" style="font-size: 30px;color:blue;">Onl</a>
                               <?php
                                    }
                                    ?>
                            </span></td>
                            <td>
                                <a href="{{URL::to('edit-product/'.$all_pro->product_id)}}" class="active"  style="font-size:15px;color:blue">Edit</a>
                                <a href="{{URL::to('delete-product/'.$all_pro->product_id)}}"class="active"  style="font-size: 15px;color:red" onclick="return confirm('Are you want to delete?')">Delete</a>
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
