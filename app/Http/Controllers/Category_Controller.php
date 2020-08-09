<?php
namespace App\Http\Controllers;

use App\Banner;
use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Exports\ExcelExport;
session_start();

class Category_Controller extends Controller
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
    public function add_category()
    {
        $this->auth_login();
        return view('admin.Category.add_category');
    }
    public function save_category(Request $request)
    {
        $this->auth_login();
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->category_status = $data['category_status'];
        $category->category_description = $data['category_description'];
        $category->meta_keywords = $data['meta_keywords'];
        $category->save();
//        $data = array();
//        $data['category_name']=$request->category_name;
//        $data['meta_keywords']=$request->meta_keywords;
//        $data['category_description']=$request->category_description;
//        $data['category_status']=$request->category_status;
//        DB::table('tbl_category')->insert($data);
        return redirect::to('/category-list');
    }
    public function category_list()
    {
        $this->auth_login();
        $category_product = Category::orderby('category_id','desc')->get();
        return view('admin.Category.all_category')->with('category_product',$category_product);
    }
    public function non_active_category($category_id)
    {
        $this->auth_login();
       Category::where('category_id',$category_id)->update(['category_status'=>'1']);
        Session::put('message','Turn off Category');
        return redirect::to('/category-list');
    }
    public function active_category($category_id)
    {
        $this->auth_login();
        Category::where('category_id',$category_id)->update(['category_status'=>'2']);
        Session::put('message','Turn on Category');
        return redirect::to('/category-list');
    }
    public function delete_category($category_id)
    {
        $this->auth_login();
        Category::where('category_id',$category_id)->delete();
        return redirect::to('/category-list');
    }
    public function show_edit_category($category_id)
    {
        $this->auth_login();
        $show_edit_category = Category::where('category_id',$category_id)->get();
        return view('admin.Category.edit_category')->with('edit_category',$show_edit_category);
    }
    public function update_category(Request $request,$category_id)
    {
        $this->auth_login();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['meta_keywords']=$request->meta_keywords;
        $data['category_description'] = $request->category_description;
        Category::where('category_id',$category_id)->update($data);
        return redirect::to('/category-list');
    }
    public function show_category(Request $request,$category_id)
    {
        $meta_description = '';
        $meta_keywords = '';
        $meta_title = '' ;
        $url_canonical = $request->url();

        $slider = Banner::orderby('slider_id','DESC')->get();
        $category_product = Category::orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = Brand::orderby('brand_id','desc')->get();
        $show_category = DB::table('tbl_product')->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
            ->where('tbl_category.category_id',$category_id)->where('tbl_product.product_status','2')->get();
        if($show_category == true){
        foreach($show_category as $key=>$value){
            $meta_description = $value->category_description;
            $meta_keywords =$value->meta_keywords ;
            $meta_title =$value->category_name ;
            $url_canonical = $request->url();
        }
        }
        return view('Home.category.show_category')->with('category_product',$category_product)->with('brand_product',$brand_product)
            ->with('show_category',$show_category)->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
    public function export_csv(){
        return Excel::download(new ExcelExport , 'category_product.xlsx');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImport, $path);
        return back();
    }
}
