<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Banner;
session_start();
class Home_Controller extends Controller
{
    public function errors_page()
    {
        return view('errors.404');
    }
    public function index(Request $request)
    {
        $slider = Banner::orderby('slider_id','DESC')->get();

       $meta_description = "Accessories for Game;Especially GamePad!";
       $meta_keywords = "GamePad and Accessories";
       $meta_title = "BeLiBo Store - GamePad World for everybody";
        $url_canonical = $request->url();

        $category_product = DB::Table('tbl_category')->orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = DB::Table('tbl_brand')->orderby('brand_id','desc')->where('brand_status','2')->get();
        $all_product = DB::table('tbl_product')->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->get();
        return view('Home.home')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
            ->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
    public function show_search(Request $request)
    {
        $slider = Banner::orderby('slider_id','DESC')->get();
        $meta_description = "Accessories for Game;Especially GamePad!";
        $meta_keywords = "GamePad and Accessories";
        $meta_title = "BeLiBo Store - GamePad World for everybody";
        $url_canonical = $request->url();

        $keywords = session::get('keywords');
        $category_product = DB::Table('tbl_category')->orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = DB::Table('tbl_brand')->orderby('brand_id','desc')->where('brand_status','2')->get();
        $show_search =  DB::table('tbl_product')->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->where('product_name','like','%'.$keywords.'%')->get();
        return view('Home.search.search')->with('category_product',$category_product)->with('brand_product',$brand_product)
            ->with('show_search',$show_search)->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
    public function search(Request $request)
    {
        $keywords = $request->search_submit;
        session::put('keywords',$keywords);
        DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->first();
        return redirect::to('/show-search');
    }
    public function send_mail()
    {
            $to_name ="Tu Hai Hiếu ";
            $to_email="deagleka1@gmail.com";
            $data = array("name"=>"Mail From Customer","body"=>"FeedBack");

            Mail::send('Home.send_mail',$data,function($message) use ($to_name,$to_email){
                 $message->to($to_email)->subject('Forgot password?');
                 $message->from($to_email,$to_name);
               });
           return redirect::to('/')->with('message','');
    }

}
