<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Image;

class Blog extends Model implements TranslatableContract
{
    use Translatable;


    /**
     * translated attributes
     */
    public $translatedAttributes = ['blogs_title', 'blogs_desc'];

    /**
     * fillable attributes
     */
    protected $fillable = ['blogs_logo', 'blogs_status'];

    /**
     * Set Category logo
     *  @param string $file
     */
    public function setBlogsLogoAttribute($file)
    {
        
        if (is_string($file)) {
          
          $this->attributes['blogs_logo'] = $file;

        } else {

          $name =  $file->getClientOriginalName();
          $name = time() . '_' . $name;

          Image::make($file)->save('uploads/blogs/'. $name);

          $this->attributes['blogs_logo'] = $name;
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
        return $query->where('blogs_status', '1');
    }


}
