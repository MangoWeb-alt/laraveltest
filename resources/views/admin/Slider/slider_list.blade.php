@extends('admin_layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Banner list
            </div>
            <?php
            $message = Session::get('message');
            if($message){
                echo '<p style="color: green;font-size: 20px;text-align: center;">'.$message.'</p>';
                Session::put('message',NULL);
            }
            ?>
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
                        <th>SliderName</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th style="width:30px; "></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banner as $key => $banner_pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$banner_pro->slider_name}}</td>
                            <td><img src="{{('style/uploads/slider/'.$banner_pro->slider_image)}}" width="120" height="100"></td>
                            <td>{{$banner_pro->slider_description}}</td>
                            <td><span class="text-ellipsis">
                           <?php
                                    if($banner_pro->slider_status == 1){
                                    ?>
                              <a href="{{URL::to('non-active-slider/'.$banner_pro->slider_id)}}" style="font-size: 30px;color:red">Off</a>
                           <?php
                                    } else {
                                    ?>
                               <a href="{{URL::to('active-slider/'.$banner_pro->slider_id)}}" style="font-size: 30px;color:blue;">Onl</a>
                               <?php
                                    }
                                    ?>
                            </span></td>
                            <td>
                                <a href="{{URL::to('delete-slider/'.$banner_pro->slider_id)}}"class="active"  style="font-size: 15px;color:red" onclick="return confirm('Are you want to delete?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

