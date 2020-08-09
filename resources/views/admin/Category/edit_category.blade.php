@extends('admin_layout')
@section('content')
    <section class="panel">
        <header class="panel-heading">
            Category
        </header>
        <div class="position-center">
            @foreach($edit_category as $key=>$value_category)
            <form action="{{URL::to('/update-category/'.$value_category->category_id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">CategoryName</label>
                    <input type="text" name="category_name" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" value="{{$value_category->category_name}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea name="category_description" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor5">{{$value_category->category_description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Keywords</label>
                    <textarea name="meta_keywords" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor9">{{$value_category->meta_keywords}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Action</label>
                </div>
                <input type="submit" name="update_category" value="Update" class="btn btn-info">
            </form>
            @endforeach
        </div>
    </section>
@endsection
