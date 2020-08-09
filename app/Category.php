<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'category_name','meta_keywords','category_description','category_status'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category';
//    public function Product()
//    {
//        return $this->belongsTo('App\Product','category_id');
//    }
}
