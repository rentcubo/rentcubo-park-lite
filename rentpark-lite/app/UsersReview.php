<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersReview extends Model
{
    public function booking(){
    	return $this->belongsTo('App\Booking');
    } 

    public function user(){
    	return $this->belongsTo('App\User');
    } 

    public function admin(){
    	return $this->belongsTo('App\Admin');
    } 
}
