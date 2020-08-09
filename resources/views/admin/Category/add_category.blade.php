@extends('admin_layout')
@section('content')
    <section class="panel">
        <header class="panel-heading">
           Category
        </header>
        <?php
        $message = Session::get('message');
        if($message){
            echo '<p style="color: green;font-size: 20px;text-align: center;">'.$message.'</p>';
            Session::put('message',NULL);
        }
        ?>
        <div class="position-center">
            <form action="{{URL::to('/save-category')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">CategoryName</label>
                    <input type="text" name="category_name" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" placeholder="Enter Category Name:">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea name="category_description" rows="8" data-validation="length" data-validation-length="min3" class="form-control" id="ckEditor"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Keywords</label>
                    <textarea name="meta_keywords" rows="8" data-validation="length" data-validation-length="min3" class="form-control" id="ckEditor8"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                </div>
                <select name="category_status" class="form-control input-sm m-bot15">
                    <option value="1">Off</option>
                    <option value="2">Onl</option>
                </select>
                <input type="submit" name="save_category" value="Save" class="btn btn-info">
            </form>

        </div>
    </section>

@endsection
