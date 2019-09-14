<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stockproduct;
use App\Saleproduct;

class SearchController extends Controller

{

   public function index()

{

return view('search');

}



public function search(Request $request)
{
  if($request->ajax())
    {
      $output="";
      $query = trim($request->search);
      $val = explode(' ', $query );
      $atr = [];
      foreach ($val as $q) {
        array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
      };
      $products = Saleproduct::orderBy('name', 'ASC')
        ->where($atr)
        ->get();
      if($products)
      {
        foreach ($products as $product) {
          $output.='<tr>'.
          '<td>'.$product->id.'</td>'.
          '<td>'.$product->name.'</td>'.
          '<td>'.$product->stock.'</td>'.
          '<td>'.$product->getPrecioMin().'</td>'.
          '</tr>';
        }
        return Response($output);
      }

    }

}

}
