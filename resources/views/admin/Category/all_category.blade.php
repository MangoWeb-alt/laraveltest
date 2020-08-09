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
                All Category
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
                        <th>CategoryName</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th style="width:30px; "></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category_product as $key=>$cate_pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$cate_pro->category_name}}</td>
                            <td>{{$cate_pro->category_description}}</td>
                            <td><span class="text-ellipsis">
                           <?php
                                    if($cate_pro->category_status == 1){
                                    ?>
                              <a href="{{URL::to('active-category/'.$cate_pro->category_id)}}" style="font-size: 30px;color:red">Off</a>
                           <?php
                                    } else {
                                    ?>
                               <a href="{{URL::to('non-active-category/'.$cate_pro->category_id)}}" style="font-size: 30px;color:blue;">Onl</a>
                               <?php
                                    }
                                    ?>
                            </span></td>
                            <td>
                                <a href="{{URL::to('edit-category/'.$cate_pro->category_id)}}" class="active"  style="font-size:15px;color:blue">Edit</a>
                                <a href="{{URL::to('delete-category/'.$cate_pro->category_id)}}"class="active"  style="font-size: 15px;color:red" onclick="return confirm('Are you want to delete?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <form action="{{url('/import-csv')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".xlsx .ods" >
                    <input type="submit" value="Import file excel" name="import_csv" class="btn btn-warning">
                </form>
                <form action="{{url('/export-csv')}}" method="POST">
                    @csrf
                    <input type="submit" value="Export file excel" name="export_csv" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
@endsection

