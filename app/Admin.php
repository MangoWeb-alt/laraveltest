<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{
   public $timestamps = false;
   protected $fillable=[
       'admin_email','admin_password','admin_name'
   ];
   protected $primaryKey = 'admin_id';
   protected $table = 'tbl_admin';

    public function roles(){
        return $this->belongsToMany('App\Roles');
    }
   public function getAuthPassword()
   {
       return $this->admin_password;
   }
}
