<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'slider_name','slider_status','slider_image','slider_description'
    ];
    protected $primaryKey='slider_id';
    protected $table='tbl_slider';

}
