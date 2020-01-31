<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentgroup extends Model
{
  public function ivatipos()
  {
      return $this->belongsToMany('App\Ivatipo');
  }

    public $timestamps = false;
}
