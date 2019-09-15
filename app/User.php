<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Image;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'password', 'avatar', 'location', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Set the client's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Set Client logo
     *  @param string $file
     */
    public function setAvatarAttribute($file)
    {

    	if ($file) {    		
	        
	        if (is_string($file)) {
	          $this->attributes['avatar'] = $file;

	        } else {

	          $name =  $file->getClientOriginalName();
	          $name = time() . '_' . $name;

	          Image::make($file)->save('uploads/users/'. $name);

	          $this->attributes['avatar'] = $name;
	        }
    	}
    }


    /**
     * bookings that belongs To this User
     */
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking', 'user_id', 'id');
    }

}
