<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ivatipo extends Model
{

  public function documentgroups()
    {
        return $this->belongsToMany('App\Documentgroup');
    }

    public $timestamps = false;
}
