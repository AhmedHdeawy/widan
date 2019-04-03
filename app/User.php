<?php

namespace App;

use Illuminate\Support\Facades\Hash;
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
        'name', 'username', 'email', 'password', 'avatar', 'location', 'status'
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

    // Get Users that belongs to Client
    public function clients()
    {
      return $this->hasMany('App\Client');
    }

    // Get Followers to this Client
    public function clientsFollowed()
    {
      return $this->belongsToMany('App\Client', 'followers', 'user_id', 'client_id');
    }

    // Get Followers to the Branch
    public function branchesFollowed()
    {
      return $this->belongsToMany('App\Branch', 'followers', 'user_id', 'branch_id');
    }

    // // Get Likes that belongs to Client
    // public function likes()
    // {
    //     return $this->hasMany('App\Like');
    // }
    //
    // // Get DisLikes that belongs to Client
    // public function dislikes()
    // {
    //     return $this->hasMany('App\Dislike');
    // }


}
