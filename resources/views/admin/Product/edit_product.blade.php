@extends('admin_layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Product
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($edit_product as $key=>$product)
                        <form action="{{URL::to('/update-product/'.$product->product_id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">ProductName</label>
                                <input type="text" name="product_name" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" value="{{$product->product_name}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">CategoryName</label>
                            </div>
                            <select name="category_name" class="form-control input-sm m-bot15">
                                    <option value="{{$product->category_id}}">{{$product->category_name}}</option>
                            </select>
                            <div class="form-group">
                                <label for="exampleInputFile">BrandName</label>
                            </div>
                            <select name="brand_name" class="form-control input-sm m-bot15">
                                    <option value="{{$product->brand_id}}">{{$product->brand_name}}</option>
                            </select>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ProductPrice</label>
                                <input type="number" name="product_price" data-validation="number"  class="form-control" id="exampleInputEmail1" value="{{$product->product_price}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ProductQuantity</label>
                                <input type="number" name="product_quantity" data-validation="number"  class="form-control" id="exampleInputEmail1" value="{{$product->product_quantity}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ProductImage</label>
                                <img src="{{URL::to('style/uploads/product/'.$product->product_image)}}">
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea name="product_description" rows="8" class="form-control" data-validation="length" data-validation-length="min3" id="ckEditor6">{{$product->product_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Keywords</label>
                                <textarea name="meta_product_keywords" rows="8" class="form-control" data-validation="length" data-validation-length="min3" id="ckEditor13">{{$product->meta_product_keywords}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Content</label>
                                <textarea name="product_content" rows="8" data-validation="length" data-validation-length="min3" class="form-control" id="ckEditor7">{{$product->product_content}}</textarea>
                            </div>
                            <input type="submit" name="update_product" value="Update" class="btn btn-info">
                        </form>
                     @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
