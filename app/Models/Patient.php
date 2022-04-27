<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patients";
    protected $fillable = ["name","title","age","gender"];
    public $timestamp=false;

    #########################################################
public function getGenderAttribute($val){
    return $val == 1 ? 'male' : 'female';
}
    public function doctor(){
        return $this->hasOneThrough('App\Models\Doctor','App\Models\Medical','patient_id','medical_id','id','id');
    }
}
