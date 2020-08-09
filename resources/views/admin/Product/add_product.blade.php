@extends('admin_layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Product
                </header>
                <div class="panel-body">
                    <div class="position-center">

                        <form action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">ProductName</label>
                                <input type="text" name="product_name" data-validation="length" data-validation-length="min3" class="form-control" id="exampleInputEmail1" placeholder="Enter Product Name:">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">CategoryName</label>
                            </div>
                            <select name="category_name" class="form-control input-sm m-bot15">
                                @foreach($category_product as $key=>$category)
                                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="exampleInputFile">BrandName</label>
                            </div>
                            <select name="brand_name" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key=>$brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ProductPrice</label>
                                <input type="number" name="product_price" data-validation="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Product price:">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ProductQuantity</label>
                                <input type="number" name="product_quantity" data-validation="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Product Quantity:">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ProductImage</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea name="product_description" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Keywords</label>
                                <textarea name="meta_product_keywords" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor12"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Content</label>
                                <textarea name="product_content" data-validation="length" data-validation-length="min3" rows="8" class="form-control" id="ckEditor3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Action</label>
                            </div>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="1">Off</option>
                                <option value="2">Onl</option>
                            </select>
                            <input type="submit" name="save_product" value="Save" class="btn btn-info">
                        </form>

                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
