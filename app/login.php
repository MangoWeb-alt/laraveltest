<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class login extends Model
{
    public $timestamps = false;
    protected $fillable=[
      'admin_email','admin_password','admin_name'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';
}
