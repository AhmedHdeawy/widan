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

    // Get Users that belongs to Client
    public function clients()
    {
        return $this->belongsToMany('App\Client', 'client_users');
    }

}
