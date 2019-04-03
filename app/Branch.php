<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'slug', 'description', 'address', 'phone', 'logo', 'location', 'status', 'client_id', 'city_id'
  ];


  // Get User that has this Client
  public function client()
  {
    return $this->belongsTo('App\Client');
  }

  // Get review  that belongs to Branch
  public function reviews()
  {
    return $this->hasMany('App\Review');
  }

  // Get City that has this Client
  public function city()
  {
    return $this->belongsTo('App\City');
  }

  // Get Followers to this Cliant
  public function followers()
  {
    return $this->belongsToMany('App\User', 'followers', 'branch_id', 'user_id');
  }

  // Get Services that belongs to Client
  public function services()
  {
    return $this->hasMany('App\Service');
  }
}
