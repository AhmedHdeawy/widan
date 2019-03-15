<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'client_id', 'service_id'
    ];

    // Get Client that has this Picture
    public function client()
    {
    	return $this->belongsTo('App\Client');
    }

    // Get Service that has this Picture
    public function service()
    {
    	return $this->belongsTo('App\Service');
    }

}
