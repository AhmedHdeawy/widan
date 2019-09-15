<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'service_translations';

    /**
     * primary key
     */
    protected $primaryKey = 'services_trans_id';


    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['services_title', 'services_desc'];


    /**
     * Service that belongs To
     */
    public function service()
    {
    	return $this->belongsTo('App\Models\Service', 'service_id', 'id');
    }

    
}
