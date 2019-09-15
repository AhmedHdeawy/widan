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
    	'name', 'phone', 'email', 'city', 'building', 'unit', 'street', 'day', 'time_from', 'time_to', 'notes', 'status', 'service_id', 'user_id'
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

}
