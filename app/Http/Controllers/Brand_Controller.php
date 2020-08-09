<?php
namespace App\Http\Controllers;
use App\Banner;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Brand;
session_start();
class Brand_Controller extends Controller
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
    public function add_brand()
    {
        $this->auth_login();
        return view('admin.Brand.add_brand');
    }
    public function save_brand(Request $request)
    {
        $this->auth_login();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_status = $data['brand_status'];
        $brand->brand_description = $data['brand_description'];
        $brand->meta_keywords = $data['meta_keywords'];
        $brand->save();
        return redirect::to('/brand-list');
    }
    public function brand_list()
    {
        $this->auth_login();
        //take(nums) == limit(nums) model --> controller
        $brand_product = Brand::orderby('brand_id','desc')->get();
//        $brand_product = DB::Table('tbl_brand')->get();
        return view('admin.Brand.all_brand')->with('brand_product',$brand_product);
    }
    public function non_active_brand($brand_id)
    {
        $this->auth_login();
       Brand::where('brand_id',$brand_id)->update(['brand_status'=>'1']);
        Session::put('message','Turn off brand');
        return redirect::to('/brand-list');
    }
    public function active_brand($brand_id)
    {
        $this->auth_login();
        Brand::where('brand_id',$brand_id)->update(['brand_status'=>'2']);
        Session::put('message','Turn on brand');
        return redirect::to('/brand-list');
    }
    public function delete_brand($brand_id)
    {
        $this->auth_login();
       Brand::where('brand_id',$brand_id)->delete();
        return redirect::to('/brand-list');
    }
    public function show_edit_brand($brand_id)
    {
        $this->auth_login();
        $show_edit_brand = Brand::where('brand_id',$brand_id)->get();
        return view('admin.Brand.edit_brand')->with('show_edit_brand',$show_edit_brand);
    }
    public function update_brand(Request $request,$brand_id)
    {
        $this->auth_login();
        $data = $request->all();
        $brand = Brand::find($brand_id);
        $brand->brand_name = $data['brand_name'];
        $brand->brand_description = $data['brand_description'];
        $brand->meta_keywords = $data['meta_keywords'];
        $brand->save();
        return redirect::to('/brand-list');
    }
    public function show_brand(Request $request,$brand_id)
    {
        $meta_description = '';
        $meta_keywords ='';
        $meta_title ='';
        $url_canonical ='';
        $slider = Banner::orderby('slider_id','DESC')->get();
        $category_product = Category::orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->where('brand_status','2')->get();
        $show_brand = DB::table('tbl_product')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->where('tbl_brand.brand_id',$brand_id)->where('tbl_product.product_status','2')->get();
        foreach($show_brand as $key=>$value){
            $meta_description = $value->brand_description;
            $meta_keywords =$value->meta_keywords ;
            $meta_title =$value->brand_name ;
            $url_canonical = $request->url();
        }
        return view('Home.brand.show_brand')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('show_brand',$show_brand)
            ->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
}
