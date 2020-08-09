@extends('admin_layout')
@section('content')
    <section class="panel">
        <header class="panel-heading">
            Brand
        </header>
        <div class="position-center">
            @foreach($show_edit_brand as $key=>$value_brand)
                <form action="{{URL::to('/update-brand/'.$value_brand->brand_id)}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">brandName</label>
                        <input type="text" name="brand_name" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" value="{{$value_brand->brand_name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="brand_description" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor4">{{$value_brand->brand_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Keywords</label>
                        <textarea name="meta_keywords" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor12">{{$value_brand->meta_keywords}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Action</label>
                    </div>
                    <input type="submit" name="update_brand" value="Update" class="btn btn-info">
                </form>
            @endforeach
{{--                <form action="{{URL::to('/update-brand/'.$show_edit_brand->brand_id)}}" method="post">--}}
{{--                    {{csrf_field()}}--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputEmail1">brandName</label>--}}
{{--                        <input type="text" name="brand_name" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" value="{{$show_edit_brand->brand_name}}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputPassword1">Description</label>--}}
{{--                        <textarea name="brand_description" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor4">{{$show_edit_brand->brand_description}}</textarea>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputPassword1">Keywords</label>--}}
{{--                        <textarea name="meta_keywords" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor12">{{$show_edit_brand->meta_keywords}}</textarea>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputFile">Action</label>--}}
{{--                    </div>--}}
{{--                    <input type="submit" name="update_brand" value="Update" class="btn btn-info">--}}
{{--                </form>--}}
        </div>
    </section>
@endsection
