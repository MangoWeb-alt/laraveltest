<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'shipping_id','customer_id', 'order_status','order_code','created_at'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';

    public function customer(){
        return $this->belongsTo('App\Customers','customer_id');
    }
    public function shipping(){
        return $this->belongsTo('App\Shipping','shipping_id');
    }

}
