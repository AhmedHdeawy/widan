<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'details', 'price', 'currency', 'status', 'client_id'
    ];


    // Get Clients that belongs to Service
    public function client()
    {
    	return $this->belongsTo('App\Client');
    }

    // Get Likes that belongs to Service
    public function likes()
    {
    	return $this->hasMany('App\Like');
    }

    // Get DisLikes that belongs to Service
    public function dislikes()
    {
    	return $this->hasMany('App\Dislike');
    }

    // Get Comments that belongs to Service
    public function pictures()
    {
    	return $this->hasMany('App\Picture');
    }
}
