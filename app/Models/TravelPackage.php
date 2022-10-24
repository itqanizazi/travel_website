<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    

  protected $guarded = [];

    public function galleries(){
        return $this->hasMany(Gallery::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
