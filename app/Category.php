<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'status'
    ];


    // Get Categories that has Cliant
    public function clients()
    {
      return $this->belongsToMany('App\Client', 'client_categories');
    }


    /**
     * Set Category logo
     *  @param string $file
     */
    public function setLogoAttribute($file)
    {
        
        if (is_string($file)) {
          
          $this->attributes['logo'] = $file;

        } else {

          $name =  $file->getClientOriginalName();
          $name = time() . '_' . $name;

          Image::make($file)->save('img/categories/'. $name);

          $this->attributes['logo'] = $name;
        }

    }

}
