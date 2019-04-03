<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'short_name', 'flag'
  ];


  // Get cities  that belongs to Client
  public function cities()
  {
    return $this->hasMany('App\City');
  }

}
