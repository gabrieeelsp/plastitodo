<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditnote extends Model
{
  protected $fillable = [
    'valor', 'client_id', 'status', 'saldo', 'created_at', 'comentario'
  ];

  public function client()
  {
    return $this->belongsTo(Client::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function creditnoteitems()
  {
    return $this->hasMany(Creditnoteitem::class);
  }

  public function nccomprobante()
  {
    return $this->hasOne(Nccomprobante::class);
  }

  public function getCreditnoteItem($saleproducto_id)
  {
    foreach($this->creditnoteitems as $item){
      if( $item->saleproduct->id == $saleproducto_id){
        return $item;
      }
    }
    return null;
  }

  public function getTotal()
  {
    $total = 0;
    foreach ($this->creditnoteitems as $item) {
      $total = $total + $item->getSubTotal();
    }
    return round($total, 2);
  }

  public $timestamps = false;
}
