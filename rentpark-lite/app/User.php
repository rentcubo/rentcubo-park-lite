<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'unique_id', 'token','mobile', 'token_expiry',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token_expiry',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookings() {

        return $this->hasMany('App\Booking');
    }

    public function users_review() {

        return $this->hasMany('App\UsersReview');
    }
    public static function boot(){
        //execute the parent's boot method 
        parent::boot();

        //delete your related models here, for example
        static::deleting(function($user)
        {

            if (count($user->bookings) > 0) {

                foreach($user->bookings as $booking)
                {
                    $booking->delete();
                } 

            }
          
            
        }); 

    }
  
}
