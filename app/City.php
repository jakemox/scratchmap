<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function attractions() {
        return $this->hasMany('App\Attraction');
    }
    
    public function country() {
        return $this->belongsTo('App\Country');
    }
}
