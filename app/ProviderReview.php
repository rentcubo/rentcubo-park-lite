<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderReview extends Model
{
    public function booking(){
    	return $this->belongsTo('App\Booking');
    } 

    public function provider(){
    	return $this->belongsTo('App\Provider');
    } 
}
