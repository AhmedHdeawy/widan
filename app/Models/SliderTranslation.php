<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'slider_translations';

    /**
     * primary key
     */
    protected $primaryKey = 'sliders_trans_id';


    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['sliders_title', 'sliders_desc'];


    /**
     * Slider that belongs To
     */
    public function slider()
    {
    	return $this->belongsTo('App\Models\Slider', 'slider_id', 'id');
    }

    
}
