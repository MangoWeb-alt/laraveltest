<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'category_id','brand_id','product_name','product_price','product_image','product_quantity','product_sold','meta_product_keywords','product_description','product_content','product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function Category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
    public function Brand()
    {
        return $this->belongsTo('App\Brand','brand_id');
    }
}
