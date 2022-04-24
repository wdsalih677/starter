<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    
    protected $fillable = [
        "name","email","password"
    ];

    public $timestamps=false;
    protected $guard='Admin';
   
    // ######################## Strat relation ############################
    // public function phone(){
    //     return $this -> hasOne('App\Phone');
    // }
    // ######################## End relation ############################

}
