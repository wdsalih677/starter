<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servic extends Model
{
    protected $table = "services";
    protected $fillable = ["name","title","created_at","updated_at"];
    protected $hidden =["created_at","updated_at","pivot"];
    public $timestamp=true;
    public function doctor(){
         
        return $this->belongsToMany('App\Models\Doctor','doctors_services','doctors_id','services_id','id','id');
    }
}

