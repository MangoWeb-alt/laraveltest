<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'name_qh','type','matp'
    ];
    protected $primaryKey = 'maqh';
    protected $table = 'tbl_quanhuyen';
}
