<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'day' ];


    /**
     * Service that has Booking
     */
    public function times()
    {
    	return $this->hasMany('App\Models\Time', 'days_id', 'id');
    }


    /**
     * Day that has Booking
     */
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking', 'days_id', 'id');
    }



}
