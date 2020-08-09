<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'delivery_matp','delivery_maqh','delivery_xaid','delivery_cost'
    ];
    protected $primaryKey = 'delivery_id';
    protected $table = 'tbl_deliveryCost';

    public function city(){
        return $this->belongsTo('App\City','delivery_matp');
    }
    public function province(){
        return $this->belongsTo('App\Province','delivery_maqh');
    }
    public function wards(){
        return $this->belongsTo('App\wards','delivery_xaid');
    }
}
