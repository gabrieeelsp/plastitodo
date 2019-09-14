<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sale;
use App\Custom\CatalogoActiveSales;
use App\Saleproduct;

use \Cache;
use App\Client;

class SaleController extends Controller
{
  public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if($request->get('daterange') != null)
      {
        $rango = explode(' - ', $request->get('daterange'));

        $date1 = explode('/', $rango[0]);
        $from = $date1[2].'-'.$date1[1].'-'.$date1[0];
        $from = date($from);

        $date2 = explode('/', $rango[1]);
        $to = $date2[2].'-'.$date2[1].'-'.$date2[0];
        $to = date($to);

      }

        $query = trim($request->get('searchText'));

        $val = explode(' ', $query );
        $atr = [];
        foreach ($val as $q) {
          array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
        };

        if($request->get('daterange') != null)
        {
          $sales = Sale::orderBy('id', 'DESC')
              ->whereHas('client', function ($query2) use ($atr) {
              $query2->where($atr);
              })
              ->whereBetween('created_at', [$from, $to])
              ->paginate(10);
        }else {
          $sales = Sale::orderBy('id', 'DESC')
              ->whereHas('client', function ($query2) use ($atr) {
              $query2->where($atr);
              })
              ->paginate(10);
        }

          return view('admin.sales.index', ['sales' => $sales, 'searchText' => $query, 'daterange' => $request->get('daterange')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //creo una nueva ventas
        $sale = new Sale();
        //asigno created_at, tengo que actualizar este valor cada vez que realizo una operacion con una venta para ver si paso el tiempo para cancelarla
        $sale->created_at = date("Y-m-d H:i:s");
        //asigno el usuario loggeado
        $sale->user_id = auth()->user()->id;

        //$sale->client_id = Client::find(1)->id;

        //guardo la venta en BD
        $sale->save();



        //voy a editar
        return redirect()->route('sales.edit', $sale->id);
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
      $sale = Sale::find($id);

      //$saleproducts = Saleproduct::orderBy('name', 'ASC')->pluck('name', 'id');

      return view('admin.sales.edit', ['sale' => $sale, 'id_edited' => $request->get('id_edited')]);
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
        //
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

              if($request->get('tipo') == 'Minorista'){
                $precio = $product->getPrecioMin();
              }else{
                $precio = $product->getPrecioMay();
              }
              $output.='<tr class="clickable-row">'.
              '<td>'.$product->id.'</td>'.
              '<td>'.$product->name.'</td>'.
              '<td>'.$precio.'</td>'.
              '<td>'.$product->getStock().'</td>'.
              '<td><button class="btn btn-sm btn-primary" onclick="select('.$product->id.')" data-dismiss="modal" >Seleccionar</button></td>'.
              '</tr>';
            }
            return Response($output);
          }

        }

    }

    public function search_client(Request $request)
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
          $clients = Client::orderBy('name', 'ASC')
            ->where($atr)
            ->get();

          if($clients)
          {
            foreach ($clients as $client) {
              $output.='<tr class="clickable-row">'.
              '<td>'.$client->id.'</td>'.
              '<td>'.$client->name.'</td>'.
              '<td>'.
              '<button class="btn btn-sm btn-primary" onclick="select_client('.$client->id.')" type="submit" >Seleccionar</button>'.

              '</td>'.
              '</tr>';

            }

            return Response($output);
          }

        }

    }

    public function update_client(Request $request, $id)
    {
        $sale = Sale::find($id);

        $sale->client_id = $request->get('client_id');

        $sale->update();

        return redirect()->route('sales.edit', $sale->id);
    }
}
