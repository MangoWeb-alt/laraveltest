{{--@extends('admin_layout')--}}
{{--@section('content')--}}
{{--    <div class="table-agile-info">--}}
{{--        <div class="panel panel-default">--}}
{{--            <div class="panel-heading">--}}
{{--                Delivery List--}}
{{--            </div>--}}
{{--            <div class="row w3-res-tb">--}}
{{--                <div class="col-sm-4">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table table-striped b-t b-light">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th style="width:20px;">--}}
{{--                            <label class="i-checks m-b-none">--}}
{{--                            </label>--}}
{{--                        </th>--}}
{{--                        <th>City</th>--}}
{{--                        <th>Province</th>--}}
{{--                        <th>Wards</th>--}}
{{--                        <th>Delivery Cost</th>--}}
{{--                        <th>Action</th>--}}
{{--                        <th style="width:30px; "></th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($show_delivery as $key=>$delivery_pro)--}}
{{--                        <tr>--}}
{{--                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>--}}
{{--                            <td>{{$delivery_pro->city->name_city}}</td>--}}
{{--                            <td>{{$delivery_pro->province->name_qh}}</td>--}}
{{--                            <td>{{$delivery_pro->wards->name_xa}}</td>--}}
{{--                            <td>{{number_format($delivery_pro->delivery_cost,'0','.',',')}} VNĐ</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{URL::to('edit-delivery/'.$delivery_pro->delivery_id)}}" class="active"  style="font-size:15px;color:blue">Edit</a>--}}
{{--                                <a href="{{URL::to('delete-delivery/'.$delivery_pro->delivery_id)}}"class="active"  style="font-size: 15px;color:red" onclick="return confirm('Are you want to delete?')">Delete</a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

