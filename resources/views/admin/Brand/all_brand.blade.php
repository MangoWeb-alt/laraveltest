@extends('admin_layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
           <?php
           $message = Session::get('message');
           if($message){
               echo '<p style="color: green;font-size: 35px;font-weight: 400;text-align: center">'.$message.'</p>';
           }
           ?>

            <div class="panel-heading">
                All brand
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
                        <th>brandName</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th style="width:30px; "></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brand_product as $key=>$brand_pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$brand_pro->brand_name}}</td>
                            <td>{{$brand_pro->brand_description}}</td>
                            <td><span class="text-ellipsis">
                           <?php
                                    if($brand_pro->brand_status == 1){
                                    ?>
                              <a href="{{URL::to('active-brand/'.$brand_pro->brand_id)}}" style="font-size: 30px;color:red">Off</a>
                           <?php
                                    } else {
                                    ?>
                               <a href="{{URL::to('non-active-brand/'.$brand_pro->brand_id)}}" style="font-size: 30px;color:blue;">Onl</a>
                               <?php
                                    }
                                    ?>
                            </span></td>
                            <td>
                                <a href="{{URL::to('edit-brand/'.$brand_pro->brand_id)}}" class="active"  style="font-size:15px;color:blue">Edit</a>
                                <a href="{{URL::to('delete-brand/'.$brand_pro->brand_id)}}"class="active"  style="font-size: 15px;color:red" onclick="return confirm('Are you want to delete?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

