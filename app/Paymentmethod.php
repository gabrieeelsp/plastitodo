<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymentmethod extends Model
{
  protected $fillable = [
    'name', 'slug'
  ];

  public $timestamps = false;
}
