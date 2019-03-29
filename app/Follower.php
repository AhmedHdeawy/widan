<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
  /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'followers';

   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   protected $fillable = [
     'client_id',
     'user_id',
   ];

}
