<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCategory extends Model
{
  /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'client_categories';

   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   protected $fillable = [
     'client_id',
     'category_id',
   ];

}
