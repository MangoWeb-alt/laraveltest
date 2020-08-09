<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\wards;
use App\Feeship;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();

class Delivery_Controller extends Controller
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
    public function update_delivery_ajax(Request $request)
    {
       $data = $request->all();
       $fee_ship = Feeship::find($data['delivery_id']);
       $delivery_value = rtrim($data['delivery_value'],',');
       $fee_ship->delivery_cost = $delivery_value;
       $fee_ship->Save();
    }
    public function load_delivery()
    {
        $fee_ship = Feeship::orderby('delivery_id','DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">'.
     '<table class="table table-borderred">
              <thread>
                     <th>City</th>
                     <th>Province</th>
                     <th>Wards</th>
                     <th>Delivery Cost</th>
              </thread>';
        foreach($fee_ship as $key => $delivery_cost){
            $output .= "
              <tbody>
                        <tr>
                             <td>".$delivery_cost->city->name_city."</td>
                             <td>".$delivery_cost->province->name_qh."</td>
                             <td>".$delivery_cost->wards->name_xa."</td>
                             <td contenteditable data-delivery_id='".$delivery_cost->delivery_id."' class='delivery_cost_edit' >".($delivery_cost->delivery_cost)."</td>
                        </tr>
                </tbody>
            ";
            }
        $output .= "</table></div>";
        echo $output;
    }
    public function insert_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->delivery_matp = $data['city'];
        $fee_ship->delivery_maqh = $data['province'];
        $fee_ship->delivery_xaid = $data['wards'];
        $fee_ship->delivery_cost  = $data['delivery_cost'];
        $fee_ship->save();
    }
    public function show_delivery()
    {
        $show_delivery = Feeship::orderby('delivery_id','DESC')->get();
        return view('admin.Delivery.Delivery_list')->with('show_delivery',$show_delivery);
    }
    public function delete_delivery($delivery_id)
    {
        Feeship::WHERE('delivery_id',$delivery_id)->delete();
        Session::put('message','Delete Items successfully');
        return redirect::to('/delivery-list');
    }
    public function edit_delivery($delivery_id)
    {
        $show_edit_delivery =  Feeship::WHERE('delivery_id',$delivery_id)->get();
        $city = City::orderby('matp','ASC')->get();
        return view('admin.Delivery.Edit_Delivery')->with(compact('show_edit_delivery','city'));
    }
    public function update_delivery(Request $request,$delivery_id)
    {
        $data = $request->all();
        $fee_ship =Feeship::find($delivery_id);
        $fee_ship->delivery_matp = $data['city'];
        $fee_ship->delivery_maqh = $data['province'];
        $fee_ship->delivery_xaid = $data['wards'];
        $fee_ship->delivery_cost  = $data['delivery_cost'];
        $fee_ship->save();
        return redirect::to('/delivery-list');
    }
    public function add_delivery()
    {
        $city = City::orderby('matp','ASC')->get();
        return view('admin.Delivery.Add_Delivery')->with('city',$city);
    }
    public function select_delivery(Request $request)
    {
            $data = $request->all();
            if($data['action']){
                if($data['action'] == "city"){
                    $select_province = Province::WHERE('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    echo '<option>Select Province</option>';
                    foreach($select_province as $key => $value_province){
                    echo '<option value="'.$value_province->maqh.'">'.$value_province->name_qh.'</option>';
                    }

                }else if($data['action'] == "province") {
                    $select_wards = wards::WHERE('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                    echo '<option>Select Wards</option>';
                    foreach($select_wards as $key => $value_wards) {
                      echo '<option value="'.$value_wards->xaid.'">'.$value_wards->name_xa.'</option>';
                    }
                }

            }
    }
}
