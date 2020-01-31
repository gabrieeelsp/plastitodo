<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Debitnote;
use App\Debitnoteitem;
use App\Saleproduct;

class DebitnoteitemController extends Controller
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
     public function store($debitnote_id, Request $request)
     {
         $debitnote = Creditnote::find($debitnote_id);

         if($request->has('saleproduct_barcode')){
           $saleproduct = Saleproduct::where('barcode', $request->get('saleproduct_barcode'))->first();
           $cantidad = 1;

           //No se encontro el BARCODE
           if($saleproduct == null){  //No se encontro el BARCODE
             return redirect()->route('debitnotes.edit', $debitnote);
           }

           //verifico que el producto no este ya en la misma Venta
           //Si lo encuentro aumento en uno la cantidad
           $debitnoteitem = $debitnote->getDebitnoteItem($saleproduct->id);
           if($debitnoteitem != null){

             $request->replace(['precio' => $debitnoteitem->precio, 'descuento' => $debitnoteitem->descuento, 'cantidad' => $debitnoteitem->cantidad + 1]);

             return $this->update($debitnote_id, $request, $debitnoteitem->id);

           }
         }else{
           $saleproduct = Saleproduct::find($request->get('saleproduct_id'));
           $cantidad = $request->get('cantidad');

           //verifico que el producto no este ya en la misma Venta
           if($debitnote->getDebitnoteItem($saleproduct->id) != null){
             return redirect()->route('debitnotes.edit', $debitnote_id);
           }
         }


         //Ya puedo ingresar el Saleitem
         $precio = 0;
         if($debitnote->client != null && $debitnote->client->tipo == 'Mayorista'){
           //Venta registrada a un cliente, ver si es mayorista o minorista
           $precio = $saleproduct->getPrecioMay();
         }else{
           //tomo el precio Minorista
           $precio = $saleproduct->getPrecioMin();
         }

         $debitnoteitem = Debitnoteitem::create( ['cantidad' => $cantidad, 'saleproduct_id' => $saleproduct->id, 'creditnote_id' => $debitnote_id, 'precio' => $precio, 'descuento' => 0]);

         return redirect()->route('debitnotes.edit', $debitnote_id);
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
     public function update($debitnote_id, Request $request, $id)
     {
       //Verifico que todos los datos sean enviados
       if($request->get('precio') == null || $request->get('descuento') == null || $request->get('cantidad') == null){
         return redirect()->route('debitnotes.edit', ['debitnote_id' => $debitnote_id, 'id_edited' => 0]);
       }
       $precio = str_replace(',','',$request->get('precio'));
       $cantidad = str_replace(',','',$request->get('cantidad'));

       $debitnoteitem = Debitnoteitem::find($id);

       $saleproduct = $debitnoteitem->saleproduct;

       $debitnoteitem->precio = $precio;
       $debitnoteitem->descuento = $request->get('descuento');
       $debitnoteitem->cantidad = $cantidad;

       $debitnoteitem->update();

       return redirect()->route('debitnotes.edit', ['debitnote_id' => $debitnote_id, 'id_edited' => $id]);
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function destroy($debitnote_id, $id)
      {
          Debitnoteitem::find($id)->delete();

          return back()->with('info', 'Eliminado correctamente.');
      }
   }
