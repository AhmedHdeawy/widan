<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Image;

class Slider extends Model implements TranslatableContract
{
    use Translatable;


    /**
     * translated attributes
     */
    public $translatedAttributes = ['sliders_title', 'sliders_desc'];

    /**
     * fillable attributes
     */
    protected $fillable = ['sliders_img', 'sliders_status'];

    /**
     * Set Category logo
     *  @param string $file
     */
    public function setSlidersImgAttribute($file)
    {
        
        if (is_string($file)) {
          
          $this->attributes['sliders_img'] = $file;

        } else {

          $name =  $file->getClientOriginalName();
          $name = time() . '_' . $name;

          Image::make($file)->save('uploads/sliders/'. $name);

          $this->attributes['sliders_img'] = $name;
        }

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
        return $query->where('sliders_status', '1');
    }



}
