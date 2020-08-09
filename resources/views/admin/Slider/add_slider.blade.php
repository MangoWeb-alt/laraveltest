@extends('admin_layout')
@section('content')
    <section class="panel">
        <header class="panel-heading">
            Add Slider
        </header>
        <?php
        $message = Session::get('message');
        if($message){
            echo '<p style="color: green;font-size: 20px;text-align: center;">'.$message.'</p>';
            Session::put('message',NULL);
        }
        ?>
        <div class="position-center">
            <form action="{{URL::to('/save-slider')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">SliderName</label>
                    <input type="text" name="slider_name" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" placeholder="Enter slider Name:">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" name="slider_image" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea name="slider_description" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor1"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                </div>
                <select name="slider_status" class="form-control input-sm m-bot15">
                    <option value="1">Off</option>
                    <option value="2">Onl</option>
                </select>
                <input type="submit" name="save_slider" value="Save" class="btn btn-info">
            </form>

        </div>
    </section>










@endsection
