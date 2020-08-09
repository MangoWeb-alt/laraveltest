@extends('admin_layout')
@section('content')
    <section class="panel">
        <header class="panel-heading">
            Insert Coupon
        </header>
        <div class="position-center">
            <form action="{{URL::to('/add-coupon')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Name</label>
                    <input type="text" name="coupon_name" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" placeholder="Enter Coupon Name:...">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Coupon Number</label>
                    <input type="number" name="coupon_number" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" placeholder="Enter Coupon Number:...">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Coupon Code</label>
                    <textarea name="coupon_code" rows="8" data-validation="length" data-validation-length="min3" class="form-control" id="ckEditor8"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Coupon Time</label>
                    <input type="text" name="coupon_time" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" placeholder="Enter Coupon Time:...">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Action</label>
                </div>
                <select name="coupon_condition" class="form-control input-sm m-bot15">
                    <option value="1">Off</option>
                    <option value="2">Onl</option>
                </select>
                <input type="submit" name="add_coupon" value="Save" class="btn btn-info">
            </form>

        </div>
    </section>










@endsection
