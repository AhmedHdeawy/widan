<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'country_id'
  ];


  // Get User that has this Client
  public function country()
  {
    return $this->belongsTo('App\Country');
  }

  // Get clients  that belongs to Client
  public function clients()
  {
    return $this->hasMany('App\Client');
  }

  // Get branches  that belongs to Client
  public function branches()
  {
    return $this->hasMany('App\Branch');
  }


}
