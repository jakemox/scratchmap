<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function users() 
    {
        return $this->belongsToMany('App\User', 'user_visited_countries', 'country_id', 'user_id');
    }
}
