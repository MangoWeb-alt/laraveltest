<?php

namespace App\Http\Controllers;
use App\Banner;
use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class Product_Controller extends Controller
{
    public function Auth_login()
    {
        $admin_id = session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        } else {
            return redirect::to('admin')->send();
        }
    }
    public function add_product()
    {
        $this->auth_login();
        $category_product = Category::orderby('category_id','DESC')->get();
        $brand_product = Brand::orderby('brand_id','DESC')->get();
        return view('admin.Product.add_product')->with('category_product',$category_product)->with('brand_product',$brand_product);
    }
    public function save_product(Request $request)
    {
        $this->auth_login();
        $data = $request->all();
        $product = new Product();
        $product->product_name =  $data['product_name'];
        $product->brand_id =  $data['brand_name'];
        $product->category_id =  $data['category_name'];
        $product->product_quantity =  $data['product_quantity'];
        $product->product_price =  $data['product_price'];
        $product->meta_product_keywords =  $data['meta_product_keywords'];
        $product->product_description =  $data['product_description'];
        $product->product_content =  $data['product_content'];
        $product->product_status =  $data['product_status'];

        $get_image =$request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('style/uploads/product',$new_image);
            $product->product_image =  $new_image;
            $product->save();
            return redirect::to('product-list');
        } else {
            $product->product_image = '';
            $product->save();
            return redirect::to('product-list');
        }
    }
    public function all_product()
    {
        $this->auth_login();
        $all_product = Product::join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->get();
        return view('admin.Product.all_product')->with('all_product',$all_product);
    }
    public function non_active_product($product_id)
    {
        $this->auth_login();
        Product::where('product_id',$product_id)->update(['product_status'=>'2']);
        return redirect::to('/product-list');
    }
    public function active_product($product_id)
    {
        $this->auth_login();
        Product::where('product_id',$product_id)->update(['product_status'=>'1']);
        return redirect::to('/product-list');
    }
    public function delete_product($product_id)
    {
        $this->auth_login();
        Product::where('product_id',$product_id)->delete();
        return redirect::to('product-list');
    }
    public function edit_product($product_id)
    {
        $this->auth_login();
       $edit_product = Product::join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('product_id',$product_id)->get();
        return view('admin.Product.edit_product')->with('edit_product',$edit_product);
    }
    public function update_product(Request $request,$product_id)
    {
        $this->auth_login();
        $data = $request->all();
        $product = Product::find($product_id);

        $product->product_name =  $data['product_name'];

        $product->brand_id =  $data['brand_name'];
        $product->category_id =  $data['category_name'];
        $product->product_quantity =  $data['product_quantity'];
        $product->product_price =  $data['product_price'];
        $product->meta_product_keywords =  $data['meta_product_keywords'];
        $product->product_description =  $data['product_description'];
        $product->product_content =  $data['product_content'];

        $get_image =$request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('style/uploads/product',$new_image);
            $product->product_image =  $new_image;

            $product->save();

            return redirect::to('product-list');
        } else {

            $product->save();

            return redirect::to('product-list');
        }
    }
    public function product_details(Request $request,$product_id)
    {
        $slider = Banner::orderby('slider_id','DESC')->get();
        $category_product = Category::orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = Brand::orderby('brand_id','desc')->where('brand_status','2')->get();
        $show_details = Product::join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->where('product_id',$product_id)->get();

        foreach($show_details as $key=>$value){
            $category_id = $value->category_id;
            $meta_description = $value->product_description;
            $meta_keywords =$value->meta_product_keywords ;
            $meta_title =$value->product_name ;
            $url_canonical = $request->url();

        }
        $related_product = Product::join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->where('tbl_category.category_id',$category_id)
            ->whereNotIn('product_id',[$product_id])->limit(3)->get();
        return view('Home.details.show_details')->with('category_product',$category_product)->with('brand_product',$brand_product)
            ->with('show_details',$show_details)->with('related_product',$related_product)->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }


}
