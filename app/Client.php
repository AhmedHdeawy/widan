<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Image;

class Client extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'description', 'address', 'phone', 'logo', 'location', 'status', 'user_id', 'city_id'
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
        // $this->attributes['password'] = bcrypt($value);
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Set Category logo
     *  @param string $file
     */
    public function setLogoAttribute($file)
    {
        
        if (is_string($file)) {
          $this->attributes['logo'] = $file;

        } else {

          $name =  $file->getClientOriginalName();
          $name = time() . '_' . $name;

          Image::make($file)->save('img/clients/'. $name);

          $this->attributes['logo'] = $name;
        }

    }

    // Get review  that belongs to Client
    public function reviews()
    {
    	return $this->hasMany('App\Review');
    }

    // Get User that has this Client
    public function user()
    {
      return $this->belongsTo('App\User');
    }


    // Get Services that belongs to Client
    public function services()
    {
    	return $this->hasMany('App\Service');
    }

    // Get Branches that belongs to Client
    public function branches()
    {
    	return $this->hasMany('App\Branch');
    }

    // Get City that has this Client
    public function city()
    {
      return $this->belongsTo('App\City');
    }

    // Get Comments that belongs to Client
    public function pictures()
    {
    	return $this->hasMany('App\Picture');
    }

    // Get Categories that has Cliant
    public function categories()
    {
    	return $this->belongsToMany('App\Category', 'client_categories');
    }

    // Get Followers to this Cliant
    public function followers()
    {
      return $this->belongsToMany('App\User', 'followers', 'client_id', 'user_id');
    }

    // // Get Likes that belongs to Client
    // public function likes()
    // {
    // 	return $this->hasMany('App\Like');
    // }
    //
    // // Get DisLikes that belongs to Client
    // public function dislikes()
    // {
    // 	return $this->hasMany('App\Dislike');
    // }

}
