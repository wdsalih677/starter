<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $table = "medicales";
    protected $fillable = ["pdf","patient_id"];
    public $timestamp=false;
}
