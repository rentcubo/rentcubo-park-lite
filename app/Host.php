<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'host_name', 'host_type', 'total_spaces', 'description',
    ];

    public function provider(){
    	return $this->belongsTo('App\Provider');
    } 

    public function service_location(){
    	return $this->belongsTo('App\ServiceLocation');
    } 

    public function booking() {

        return $this->hasMany('App\Booking');
    }

}
