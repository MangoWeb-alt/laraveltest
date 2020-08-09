<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wards extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'name_xa','type','maqh'
    ];
    protected $primaryKey = 'xaid';
    protected $table = 'tbl_xaphuongthitran';
}
