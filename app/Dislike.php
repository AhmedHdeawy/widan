<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'body', 'images', 'client_id', 'service_id', 'user_id'
  ];

  // Get Client that has this like
  public function client()
  {
    return $this->belongsTo('App\Client');
  }

  // Get Client that has this like
  public function service()
  {
    return $this->belongsTo('App\Service');
  }


  // Get User that has this like
  public function user()
  {
    return $this->belongsTo('App\Client');
  }
}
