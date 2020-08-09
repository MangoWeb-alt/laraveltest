@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <div class="fb-like" data-href="http://hoclaravel.com" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
        <div class="fb-share-button" data-href="http://hoclaravel.com" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u{{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
        <h2 class="title text-center">Features Items</h2>
        @foreach($show_category as $key=>$value_category)
            <a href="{{URL::to('/product-details/'.$value_category->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('style/uploads/product/'.$value_category->product_image)}}"width="120" height="150" alt="" />
                        <h2>{{number_format($value_category->product_price)}} VNĐ</h2>
                        <p>{{$value_category->product_name}}</p>
                        <a href="{{URL::to('/product-details/'.$value_category->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Show Details</a>
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
            </a>
    @endforeach
    </div><!--features_items-->
@endsection
