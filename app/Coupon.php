<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'coupon_name','coupon_number','coupon_code','coupon_time','coupon_condition'
    ];
    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';
}
