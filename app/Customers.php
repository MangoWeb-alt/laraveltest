<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'customer_name','customer_email','customer_password','customer_address','customer_phone'
        ];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customer';
}
