<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'phone', 'email', 'city', 'building', 'unit', 'street', 'notes', 'status', 'price', 'service_id', 'user_id', 'days_id', 'times_id'
    ];


    /**
     * Service that has Booking
     */
    public function service()
    {
    	return $this->belongsTo('App\Models\Service', 'service_id', 'id');
    }

    /**
     * User that has Booking
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Day that belongs to Booking
     */
    public function day()
    {
        return $this->belongsTo('App\Models\Day', 'days_id', 'id');
    }


    /**
     * Day that belongs to Booking
     */
    public function time()
    {
        return $this->belongsTo('App\Models\Time', 'times_id', 'id');
    }

}
