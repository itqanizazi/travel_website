<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   

    protected $guarded = [];

    public function travel_packages(){
        return $this->hasMany(TravelPackage::class);
    }
}
