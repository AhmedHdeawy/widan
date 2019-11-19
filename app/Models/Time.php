<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'days_id', 'time_from', 'time_to', 'num_of_hours', 'booking_count'
    ];

    /**
     * Service that has Booking
     */
    public function day()
    {
    	return $this->belongsTo('App\Models\Day', 'days_id', 'id');
    }

    /**
     * Time that has Booking
     */
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking', 'times_id', 'id');
    }

}
