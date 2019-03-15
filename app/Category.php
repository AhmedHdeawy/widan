<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
      'status'
  ];


  // Get Categories that has Cliant
  public function clients()
  {
    return $this->belongsToMany('App\Client', 'client_categories');
  }

}
