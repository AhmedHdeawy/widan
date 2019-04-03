<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'client_id', 'service_id', 'branches_id', 'evaluation', 'comment'
  ];


  // Get User that has this Review
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  // Get Client that has this Review
  public function client()
  {
    return $this->belongsTo('App\Client');
  }

  // Get Branch that has this Review
  public function branch()
  {
    return $this->belongsTo('App\Branch');
  }

  // Get Service that has this Review
  public function service()
  {
    return $this->belongsTo('App\Service');
  }

  // Get Replies that Belongs To this Review
  public function replies()
  {
    return $this->hasMany('App\Reply');
  }

}
