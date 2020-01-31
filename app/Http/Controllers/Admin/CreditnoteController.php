<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Creditnote;
use App\Nccomprobante;

class CreditnoteController extends Controller
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
    public function create(Request $request)
    {

      //creo una nueva ventas
      $creditnote = new Creditnote();
      //asigno created_at, tengo que actualizar este valor cada vez que realizo una operacion con una venta para ver si paso el tiempo para cancelarla
      $creditnote->created_at = date("Y-m-d H:i:s");

      //asigno el usuario loggeado
      $creditnote->user_id = auth()->user()->id;

      //Asigno el Cliente
      $creditnote->client_id = $request->get('client_id');

      //guardo la venta en BD
      $creditnote->save();

      //voy a editar
      return redirect()->route('creditnotes.edit', $creditnote->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($creditnote_id, Request $request)
    {

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
    public function edit(Request $request, $id)
    {
      $creditnote = Creditnote::find($id);

      $creditnotes_user = Creditnote::where('user_id', auth()->user()->id)
        ->where('status', 'EDITANDO')
        ->get();

/*
      if($sale->status == 'COBRANDO'){

        $paymentmethods = Paymentmethod::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.sales.edit_multipagos', ['sale' => $sale, 'sales_user' => $sales_user, 'paymentmethods' => $paymentmethods]);
      }
      */
      $comprobantes = [];

      if($creditnote->client != null){
        $tipos_comprobante = $creditnote->client->ivatipo->documentgroups()->get();

        foreach($tipos_comprobante as $tipo){
          if($tipo->name == 'A'){

              array_push($comprobantes, 'A');
          }
          if($tipo->name == 'B'){

              array_push($comprobantes, 'B');
          }
          if($tipo->name == 'TZ'){
              //$comprobantes = array_add($comprobantes,'TZ', ['Ticket']);
              array_push($comprobantes, 'TZ');
          }

        }
      }


      //dd($comprobantes);

      return view('admin.creditnotes.edit', ['creditnote' => $creditnote, 'id_edited' => $request->get('id_edited'), 'creditnotes_user' => $creditnotes_user, 'comprobantes' => $comprobantes]);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       $creditnote = Creditnote::find($id);

       $client_id = $creditnote->client_id;

       $creditnote->delete();


       return redirect()->route('clients.show', $client_id);

     }

     public function set_tipo_comprobante(Request $request, $id)
     {
         $creditnote = Creditnote::find($id);

         $creditnote->tipo_comprobante = $request->get('tipo_comprobante');

         $creditnote->update();

         return redirect()->route('creditnotes.edit', $creditnote->id);
     }

     public function guardar(Request $request, $id){
       $creditnote = Creditnote::find($id);
       $creditnote->status = 'CONFIRMADO';

       //Actualizo el stock de cada producto
       foreach($creditnote->creditnoteitems as $item){
         $stockproduct = $item->saleproduct->stockproduct;

         $stockproduct->stock = $stockproduct->stock + ($item->cantidad * $item->saleproduct->rel_venta_stock);

         $stockproduct->update();
       }

       $creditnote->total = $creditnote->getTotal();

       $creditnote->saldo = $creditnote->client->saldo - $creditnote->getTotal();

       $creditnote->update();

       $client = $creditnote->client;
       $client->saldo = $client->saldo - $creditnote->getTotal();
       $client->update();

       //si se generó todo correctamente
       if($this->emitir_comprobante($creditnote)){
         return redirect()->route('clients.show', $creditnote->client_id);
       }

       return redirect()->route('clients.show', $creditnote->client_id);

     }

     public function emitir_comprobante($creditnote){
       if($creditnote->tipo_comprobante == null){

       }elseif($creditnote->tipo_comprobante == 'TZ'){

         $comprobante = new Nccomprobante();
         if($creditnote->client != null){
           $comprobante->client_id = $creditnote->client->id;
         }
         $comprobante->tipo = 'NCTZ';
         $comprobante->creditnote_id = $creditnote->id;

         $comprobante->valor = $creditnote->getTotal();

         //imprimo comprobante en la impresora fiscal
         if(true){  //si se imprimio correctmente devuelvo el numero de comprobante
           $comprobante->numero = '0001-00000343';
           $comprobante->created_at = $creditnote->created_at;
           $comprobante->save();

           return true;
         }


       }elseif($creditnote->tipo_comprobante == 'A'){
         $comprobante = new Nccomprobante();

         $comprobante->client_id = $creditnote->client->id;

         $comprobante->tipo = 'NCA';
         $comprobante->creditnote_id = $creditnote->id;

         $comprobante->valor = $creditnote->getTotal();

         //imprimo comprobante en la impresora fiscal
         if(true){  //si se imprimio correctmente devuelvo el numero de comprobante
           $comprobante->numero = '0001-00037464';
           $comprobante->created_at = $creditnote->created_at;
           $comprobante->save();

           return true;
         }

       }elseif($creditnote->tipo_comprobante == 'B'){
         $comprobante = new Nccomprobante();

         $comprobante->client_id = $creditnote->client->id;

         $comprobante->tipo = 'NCB';
         $comprobante->creditnote_id = $creditnote->id;

         $comprobante->valor = $creditnote->getTotal();

         //imprimo comprobante en la impresora fiscal
         if(true){  //si se imprimio correctmente devuelvo el numero de comprobante
           $comprobante->numero = '0001-0000443043';
           $comprobante->created_at = $creditnote->created_at;
           $comprobante->save();

           return true;
         }
       }
     }
}
