<?php

namespace App\Models;

use App\Scopes\doctorScope;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctors";
    protected $fillable = ["name","title","gender","status","hospital_id","medical_id","created_at","updated_at"];
    protected $hidden =["created_at","updated_at",];
    public $timestamp=true;
    ##################################################################
    protected static function boot()
    {
         parent::boot();
        static::addGlobalScope(new doctorScope);
    }
    ##################################################################
    public function scopeInvalid($query){
        $query->whereNotNull('name');

    }
    public function ScopeInactive($query){
      return  $query->where('status',0);
    }
    public function hospital(){
        return $this -> belongsTo('App\Models\Hospital','hospital_id','id');
    }

    ######### Many 2 Many #########
    // 1-الموودل
    // 2-الجدول الرابط بين الجدولين
    // 3-آدي الجدول الاول
    // 4-آدي الجدول الثاني
    // 5-المفتاح الاساسي للجدول الاول
    // 6-المفتأح الاساسي للجدول التاني
    public function service(){
        return $this -> belongsToMany('App\Models\Servic','doctors_services','doctors_id','services_id','id','id');
    }
}
