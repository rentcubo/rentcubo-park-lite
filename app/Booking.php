<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

	public function provider(){
    	return $this->belongsTo('App\Provider');
    } 


    public function service_location(){
    	return $this->belongsTo('App\ServiceLocation');
    } 

    public function user(){
    	return $this->belongsTo('App\User');
    } 

    public function host(){
    	return $this->belongsTo('App\Host');
    } 

    public function provider_review(){
        return $this->hasOne('App\ProviderReview');
    } 

    public function users_review() {

        return $this->hasMany('App\UsersReview');
    }
}
