@extends('welcome')
@section('content')


<div class="features_items"><!--features_items-->
    <div class="fb-like" data-href="http://localhost" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
    <div class="fb-share-button" data-href="http://localhost" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u{{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
    <h2 class="title text-center">Features Items</h2>
    @foreach($all_product as $key=>$value)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        {{csrf_field()}}
                        <input type="hidden" name="cart_product_id" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" name="cart_product_name" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" name="cart_product_image" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" name="cart_product_price" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                        <input type="hidden" name="cart_product_quantity" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                        <input type="hidden" name="cart_product_qty" value="1" class="cart_product_qty_{{$value->product_id}}">
                    <a href="{{URL::to('/product-details/'.$value->product_id)}}">
                    <img src="{{URL::to('style/uploads/product/'.$value->product_image)}}" width="120" height="150" alt="" />
                    <h2>{{number_format($value->product_price)}} VNĐ</h2>
                    <p>{{$value->product_name}}</p>
{{--                    <a href="{{URL::to('/product-details/'.$value->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Show Details</a>--}}
               </a>
                       <button type="button" class="btn btn-default add-to-cart" data-id="{{$value->product_id}}">Add To Cart</button>
                    </form>
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
