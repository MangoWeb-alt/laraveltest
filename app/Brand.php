<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'brand_name','brand_description','meta_keywords','brand_status'
    ];
    protected $primaryKey='brand_id';
    protected $table='tbl_brand';

}
