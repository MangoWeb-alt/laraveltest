@extends('welcome')
@section('content')

    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Search Value</h2>
        @foreach($show_search as $key=>$value)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{URL::to('style/uploads/product/'.$value->product_image)}}" width="120" height="150" alt="" />
                            <h2>{{number_format($value->product_price)}} VNĐ</h2>
                            <p>{{$value->product_name}}</p>
                            <a href="{{URL::to('/product-details/'.$value->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Show Details</a>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--features_items-->


@endsection
