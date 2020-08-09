<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Banner;
class Banner_Controller extends Controller
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
    public function manage_slider()
    {
        $this->auth_login();
        $banner = Banner::orderby('slider_id','DESC')->get();
        return view('admin.Slider.slider_list')->with(compact('banner'));
    }
    public function add_slider()
    {
        $this->auth_login();
      return view('admin.Slider.add_slider');
    }
    public function save_slider(Request $request)
    {
        $data = $request->all();
        $this->auth_login();

        $get_image =$request->file('slider_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image ->move('style/uploads/slider',$new_image);

            $slider = new Banner();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_description = $data['slider_description'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->save();

            return redirect::to('manage-slider');
        } else {
            Session::put('message','Please add images');
            return redirect::to('add-slider');
        }
    }
    public function non_active_slider($slider_id)
    {
        $this->auth_login();
        Banner::where('slider_id',$slider_id)->update(['slider_status'=>'2']);
        Session::put('message','Slider Onl');
        return redirect::to('/manage-slider');
    }
    public function active_slider($slider_id)
    {
        $this->auth_login();
        Banner::where('slider_id',$slider_id)->update(['slider_status'=>'1']);
        Session::put('message','Slider Off');
        return redirect::to('/manage-slider');
    }
    public function delete_slider($slider_id)
    {
        $this->auth_login();
        Banner::where('slider_id',$slider_id)->delete();
        Session::put('message','Delete slider successfully');
        return redirect::to('/manage-slider');
    }
}
