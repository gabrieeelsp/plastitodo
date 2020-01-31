<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Creditnote;
use App\Creditnoteitem;
use App\Saleproduct;

class CreditnoteitemController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store($creditnote_id, Request $request)
  {
      $creditnote = Creditnote::find($creditnote_id);

      if($request->has('saleproduct_barcode')){
        $saleproduct = Saleproduct::where('barcode', $request->get('saleproduct_barcode'))->first();
        $cantidad = 1;

        //No se encontro el BARCODE
        if($saleproduct == null){  //No se encontro el BARCODE
          return redirect()->route('creditnotes.edit', $creditnote);
        }

        //verifico que el producto no este ya en la misma Venta
        //Si lo encuentro aumento en uno la cantidad
        $creditnoteitem = $creditnote->getCreditnoteItem($saleproduct->id);
        if($creditnoteitem != null){

          $request->replace(['precio' => $creditnoteitem->precio, 'descuento' => $creditnoteitem->descuento, 'cantidad' => $creditnoteitem->cantidad + 1]);

          return $this->update($creditnote_id, $request, $creditnoteitem->id);

        }
      }else{
        $saleproduct = Saleproduct::find($request->get('saleproduct_id'));
        $cantidad = $request->get('cantidad');

        //verifico que el producto no este ya en la misma Venta
        if($creditnote->getCreditnoteItem($saleproduct->id) != null){
          return redirect()->route('creditnotes.edit', $creditnote_id);
        }
      }


      //Ya puedo ingresar el Saleitem
      $precio = 0;
      if($creditnote->client != null && $creditnote->client->tipo == 'Mayorista'){
        //Venta registrada a un cliente, ver si es mayorista o minorista
        $precio = $saleproduct->getPrecioMay();
      }else{
        //tomo el precio Minorista
        $precio = $saleproduct->getPrecioMin();
      }

      $creditnoteitem = Creditnoteitem::create( ['cantidad' => $cantidad, 'saleproduct_id' => $saleproduct->id, 'creditnote_id' => $creditnote_id, 'precio' => $precio, 'descuento' => 0]);

      return redirect()->route('creditnotes.edit', $creditnote_id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update($creditnote_id, Request $request, $id)
  {
    //Verifico que todos los datos sean enviados
    if($request->get('precio') == null || $request->get('descuento') == null || $request->get('cantidad') == null){
      return redirect()->route('creditnotes.edit', ['creditnote_id' => $creditnote_id, 'id_edited' => 0]);
    }
    $precio = str_replace(',','',$request->get('precio'));
    $cantidad = str_replace(',','',$request->get('cantidad'));

    $creditnoteitem = Creditnoteitem::find($id);

    $saleproduct = $creditnoteitem->saleproduct;

    $creditnoteitem->precio = $precio;
    $creditnoteitem->descuento = $request->get('descuento');
    $creditnoteitem->cantidad = $cantidad;

    $creditnoteitem->update();

    return redirect()->route('creditnotes.edit', ['creditnote_id' => $creditnote_id, 'id_edited' => $id]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($creditnote_id, $id)
   {
       Creditnoteitem::find($id)->delete();

       return back()->with('info', 'Eliminado correctamente.');
   }
}
