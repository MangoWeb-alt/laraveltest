{{--@extends('admin_layout')--}}
{{--@section('content')--}}
{{--    <section class="panel">--}}
{{--        <?php--}}
{{--        $message = Session::get('message');--}}
{{--        if($message){--}}
{{--            echo '<p style="color: green;font-size: 20px;text-align: center;">'.$message.'</p>';--}}
{{--            Session::put('message',NULL);--}}
{{--        }--}}
{{--        ?>--}}
{{--        <header class="panel-heading">--}}
{{--            Delivery--}}
{{--        </header>--}}
{{--            @foreach($show_edit_delivery as $key => $value_delivery)--}}
{{--        <div class="position-center">--}}
{{--            <form action="{{('/update-delivery/'.$value_delivery->delivery_id)}}" method="post">--}}
{{--                {{csrf_field()}}--}}
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputFile">Select City</label>--}}
{{--                </div>--}}
{{--                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">--}}
{{--                    <option value="">Select City</option>--}}
{{--                       @foreach($city as $key =>$value_city)--}}
{{--                           <option value="{{$value_city->matp}}">{{$value_city->name_city}}</option>--}}
{{--                        @endforeach--}}
{{--                </select>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputFile">Select Province</label>--}}
{{--                </div>--}}
{{--                <select name="province" id="province" class="form-control input-sm m-bot15 choose province">--}}
{{--                    <option value="">Select province</option>--}}
{{--                </select>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputFile">Select wards</label>--}}
{{--                </div>--}}
{{--                <select name="wards" id="wards" class="form-control input-sm m-bot15 choose wards">--}}
{{--                    <option value="">Select wards</option>--}}
{{--                </select>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputEmail1">DeliveryCost</label>--}}
{{--                    <input type="text" name="delivery_cost" id="delivery_cost" data-validation="number" data-validation-length="min1" class="form-control delivery_cost" value="{{$value_delivery->delivery_cost}}" ">--}}
{{--                </div>--}}
{{--                <input type="submit" name="edit_delivery_cost" class="btn btn-info edit_delivery_cost" value="Update">--}}
{{--            </form>--}}
{{--        </div>--}}
{{--            @endforeach--}}
{{--    </section>--}}
{{--@endsection--}}
