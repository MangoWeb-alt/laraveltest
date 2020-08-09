@extends('admin_layout')
@section('content')
    <section class="panel">
        <header class="panel-heading">
            brand
        </header>
        <div class="position-center">
            <form action="{{URL::to('/save-brand')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">brandName</label>
                    <input type="text" name="brand_name" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" placeholder="Enter brand Name:">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea name="brand_description" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor1"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Keywords</label>
                    <textarea name="meta_keywords" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor11"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                </div>
                <select name="brand_status" class="form-control input-sm m-bot15">
                    <option value="1">Off</option>
                    <option value="2">Onl</option>
                </select>
                <input type="submit" name="save_brand" value="Save" class="btn btn-info">
            </form>

        </div>
    </section>










@endsection
