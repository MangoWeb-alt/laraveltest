<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'order_code', 'product_id', 'product_name','product_price','product_sales_quantity','coupon_code','product_feeship'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
    public function coupon(){
        return $this->belongsTo('App\Coupon','coupon_code');
    }
}
