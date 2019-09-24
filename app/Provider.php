<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\ProviderResetPasswordNotification;


class Provider extends Authenticatable
{

    use Notifiable;

 //    protected $fillable = [

 //    'name',
 //    'email', 
 //    'password', 
 //    'description',
 //    'mobile',
 //    'picture',
 //    'work',
 //    'school',
 //    'languages',
	// ];

	protected $hidden = [
        'password', 
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	protected $fillable = [
        'name', 'email', 'password', 'description',
    ];

    public function hosts() {

        return $this->hasMany('App\Host');
    }

    public function service_locations() {

        return $this->hasMany('App\ServiceLocation');
    }

    public function bookings() {

        return $this->hasMany('App\Booking');
    }

    public function sendPasswordResetNotification($token) {

        $this->notify(new ProviderResetPasswordNotification($token));
    }

    public function provider_review() {

        return $this->hasMany('App\ProviderReview');
    }

    public function scopeApproved($query) { 
            
        return $query->where('status', APPROVED)->orderBy('name');
    }
    public static function boot(){
        //execute the parent's boot method 
        parent::boot();

        //delete your related models here, for example
        static::deleting(function($provider)
        {

            if ($provider) {

                if($provider->picture) {

                    delete_picture($provider->picture , PROFILE_PATH_USER);
 
                }
            }

            if (count($provider->hosts) > 0) {

                foreach($provider->hosts as $host)
                {
                    $host->delete();
                } 

            }
          
            
        }); 

    }


}
