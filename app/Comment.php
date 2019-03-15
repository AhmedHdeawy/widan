<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'images'
    ];

    // Get Client that has this like
    public function client()
    {
    	return $this->belongsTo('App\Client');
    }


    // Get User that has this like
    public function user()
    {
    	return $this->belongsTo('App\Client');
    }
}
