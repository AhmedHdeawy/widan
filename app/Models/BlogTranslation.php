<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'blog_translations';

    /**
     * primary key
     */
    protected $primaryKey = 'blogs_trans_id';


    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['blogs_title', 'blogs_desc'];


    /**
     * Blog that belongs To
     */
    public function blog()
    {
    	return $this->belongsTo('App\Models\Blog', 'blog_id', 'id');
    }

    
}
