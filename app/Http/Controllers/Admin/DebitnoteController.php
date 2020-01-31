<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Debitnote;
use App\Ndcomprobante;

class DebitnoteController extends Controller
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
      $debitnote = new Debitnote();
      //asigno created_at, tengo que actualizar este valor cada vez que realizo una operacion con una venta para ver si paso el tiempo para cancelarla
      $debitnote->created_at = date("Y-m-d H:i:s");

      //asigno el usuario loggeado
      $debitnote->user_id = auth()->user()->id;

      //Asigno el Cliente
      $debitnote->client_id = $request->get('client_id');

      //guardo la venta en BD
      $debitnote->save();

      //voy a editar
      return redirect()->route('debitnotes.edit', $debitnote->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
       $debitnote = Debitnote::find($id);

       $debitnotes_user = Debitnote::where('user_id', auth()->user()->id)
         ->where('status', 'EDITANDO')
         ->get();

 /*
       if($sale->status == 'COBRANDO'){

         $paymentmethods = Paymentmethod::orderBy('name', 'ASC')->pluck('name', 'id');

         return view('admin.sales.edit_multipagos', ['sale' => $sale, 'sales_user' => $sales_user, 'paymentmethods' => $paymentmethods]);
       }
       */
       $comprobantes = [];

       if($debitnote->client != null){
         $tipos_comprobante = $debitnote->client->ivatipo->documentgroups()->get();

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

       return view('admin.debitnotes.edit', ['debitnote' => $debitnote, 'id_edited' => $request->get('id_edited'), 'debitnotes_user' => $debitnotes_user, 'comprobantes' => $comprobantes]);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       $debitnote = Debitnote::find($id);

       $client_id = $debitnote->client_id;

       $debitnote->delete();


       return redirect()->route('clients.show', $client_id);

     }

     public function set_tipo_comprobante(Request $request, $id)
     {
         $debitnote = Debitnote::find($id);

         $debitnote->tipo_comprobante = $request->get('tipo_comprobante');

         $debitnote->update();

         return redirect()->route('debitnotes.edit', $debitnote->id);
     }

     public function guardar(Request $request, $id){
       $debitnote = Debitnote::find($id);
       $debitnote->status = 'CONFIRMADO';

       //Actualizo el stock de cada producto
       foreach($debitnote->debitnoteitems as $item){
         $stockproduct = $item->saleproduct->stockproduct;

         $stockproduct->stock = $stockproduct->stock - ($item->cantidad * $item->saleproduct->rel_venta_stock);

         $stockproduct->update();
       }

       $debitnote->total = $creditnote->getTotal();

       $debitnote->saldo = $creditnote->client->saldo - $debitnote->getTotal();

       $debitnote->update();

       $client = $debitnote->client;
       $client->saldo = $client->saldo - $debitnote->getTotal();
       $client->update();

       //si se generó todo correctamente
       if($this->emitir_comprobante($debitnote)){
         return redirect()->route('clients.show', $debitnote->client_id);
       }

       return redirect()->route('clients.show', $debitnote->client_id);

     }

     public function emitir_comprobante($debitnote){
       if($debitnote->tipo_comprobante == null){

       }elseif($debitnote->tipo_comprobante == 'TZ'){

         $comprobante = new Ndcomprobante();
         if($debitnote->client != null){
           $comprobante->client_id = $debitnote->client->id;
         }
         $comprobante->tipo = 'NDTZ';
         $comprobante->debitnote_id = $debitnote->id;

         $comprobante->valor = $debitnote->getTotal();

         //imprimo comprobante en la impresora fiscal
         if(true){  //si se imprimio correctmente devuelvo el numero de comprobante
           $comprobante->numero = '0001-00000343';
           $comprobante->created_at = $debitnote->created_at;
           $comprobante->save();

           return true;
         }


       }elseif($debitnote->tipo_comprobante == 'A'){
         $comprobante = new Ndcomprobante();

         $comprobante->client_id = $debitnote->client->id;

         $comprobante->tipo = 'NDA';
         $comprobante->ditnote_id = $debitnote->id;

         $comprobante->valor = $debitnote->getTotal();

         //imprimo comprobante en la impresora fiscal
         if(true){  //si se imprimio correctmente devuelvo el numero de comprobante
           $comprobante->numero = '0001-00037464';
           $comprobante->created_at = $debitnote->created_at;
           $comprobante->save();

           return true;
         }

       }elseif($debitnote->tipo_comprobante == 'B'){
         $comprobante = new Ndcomprobante();

         $comprobante->client_id = $debitnote->client->id;

         $comprobante->tipo = 'NDB';
         $comprobante->debitnote_id = $debitnote->id;

         $comprobante->valor = $debitnote->getTotal();

         //imprimo comprobante en la impresora fiscal
         if(true){  //si se imprimio correctmente devuelvo el numero de comprobante
           $comprobante->numero = '0001-0000443043';
           $comprobante->created_at = $debitnote->created_at;
           $comprobante->save();

           return true;
         }
       }
     }
}
