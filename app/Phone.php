<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = "phones";
    protected $fillable = ["code","phone","user_id"];
    protected $hidden=["user_id"];
    public $timestamps=false;
    ######################## Strat relation ############################
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    ######################## End relation ############################
}
