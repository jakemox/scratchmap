<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function users() 
    {
        return $this->belongsToMany('App\User', 'user_visited_countries', 'country_id', 'user_id');
    }

    public function cities() {
        return $this->hasMany('App\City','country_code','code');
    }
}
