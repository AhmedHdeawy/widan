<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'text	', 'review_id', 'user_id'
  ];


  // Get User that has this Review
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  // Get Client that has this Review
  public function review()
  {
    return $this->belongsTo('App\Review');
  }

}
