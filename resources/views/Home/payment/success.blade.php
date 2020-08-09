@extends('welcome')
@section('content')
    <style>
        .review-payment h2{
            font-size:25px;
            font-family: Sans-Serif;
            color:green;
        }
    </style>
    <section id="cart_items">
        <div class="container">
            <div class="review-payment">
                <h2>Thank you for your order. We will contact to you as soon as possible!!!</h2>
                <a href="{{URL::to('/Home')}}">Click here to come to Home</a>
            </div>

        </div>
    </section> <!--/#cart_items-->
@endsection
