<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'description', 'address', 'phone', 'logo', 'location', 'open_at', 'close_at', 'working_all', 'status'
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

    // Get Services that belongs to Client
    public function services()
    {
    	return $this->hasMany('App\Service');
    }

    // Get Likes that belongs to Client
    public function likes()
    {
    	return $this->hasMany('App\Like');
    }

    // Get DisLikes that belongs to Client
    public function dislikes()
    {
    	return $this->hasMany('App\Dislike');
    }

    // Get Comments that belongs to Client
    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

    // Get Comments that belongs to Client
    public function pictures()
    {
    	return $this->hasMany('App\Picture');
    }

    // Get Users that belongs to Client
    public function users()
    {
    	return $this->belongsToMany('App\User', 'client_users');
    }

    // Get Categories that has Cliant
    public function categories()
    {
    	return $this->belongsToMany('App\Category', 'client_categories');
    }

}
