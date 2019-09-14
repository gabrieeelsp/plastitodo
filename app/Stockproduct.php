<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockproduct extends Model
{
    protected $fillable = [
      'category_id', 'name', 'slug', 'costo', 'stock', 'stock_deposito', 'stockproductgroup_id',
    ];

    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function stockproductgroup()
    {
      return $this->belongsTo(Stockproductgroup::class);
    }

    public $timestamps = false;

  }
