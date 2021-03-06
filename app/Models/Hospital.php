<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = "hospitals";
    protected $fillable = ["name","address","created_at","updated_at"];
    protected $hidden =["created_at","updated_at"];
    public $timestamp=true;
    public function doctor(){
        return $this -> hasMany('App\Models\Doctor','hospital_id','id');
    }
    public function setNameAttribute($value){
        //method to set data in db captal
        $this -> name = strtoupper($value);
    }
}
