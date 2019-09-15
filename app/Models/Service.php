<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Image;

class Service extends Model implements TranslatableContract
{
    use Translatable;


    /**
     * translated attributes
     */
    public $translatedAttributes = ['services_title', 'services_desc'];

    /**
     * fillable attributes
     */
    protected $fillable = ['services_logo', 'services_status'];

    /**
     * Set Category logo
     *  @param string $file
     */
    public function setServicesLogoAttribute($file)
    {
        
        if (is_string($file)) {
          
          $this->attributes['services_logo'] = $file;

        } else {

          $name =  $file->getClientOriginalName();
          $name = time() . '_' . $name;

          Image::make($file)->save('uploads/services/'. $name);

          $this->attributes['services_logo'] = $name;
        }

    }


    /**
     * bookings that belongs To this Service
     */
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking', 'service_id', 'id');
    }


    /**
     * Scope a query to fetch Active data only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('services_status', '1');
    }



}
