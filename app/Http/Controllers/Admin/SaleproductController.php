<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Saleproduct;
use App\Stockproduct;
use App\Saleproductgroup;

class SaleproductController extends Controller
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
    public function index($stockproduct_id = 0, Request $request)
    {

      $query = trim($request->get('searchText'));

      $val = explode(' ', $query );
      $atr = [];
      foreach ($val as $q) {
        array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
      };

      $selectedItems = [];

      if ($request->has('selectedItems')) {
        $selectedItems = $request->get('selectedItems');

      }


      if($stockproduct_id != 0){
        $saleproducts = Saleproduct::orderBy('name', 'ASC')
          ->where('stockproduct_id', $stockproduct_id)
          ->where($atr)
          ->paginate(5);

          $stockproduct = Stockproduct::find($stockproduct_id);

          return view('admin.saleproducts.index', ['saleproducts' => $saleproducts, 'searchText' => $query, 'stockproduct' => $stockproduct]);
        }else{
          $saleproducts = Saleproduct::orderBy('name', 'ASC')
            ->where($atr)
            ->paginate(15);

            return view('admin.saleproducts.lista_de_precios', ['saleproducts' => $saleproducts, 'searchText' => $query, 'selectedItems' => $selectedItems]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($stockproduct_id)
    {
      $stockproduct = Stockproduct::find($stockproduct_id);

      $saleproductgroups = Saleproductgroup::orderBy('name', 'ASC')->pluck('name', 'id');

      return view('admin.saleproducts.create', compact('stockproduct', 'saleproductgroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($stockproduct_id, Request $request)
    {
      $saleproduct = Saleproduct::create($request->all() + ['stockproduct_id' => $stockproduct_id]);


      return redirect()->route('stockproducts.saleproducts.edit', [$stockproduct_id, $saleproduct->id])
        ->with('info', 'Producto Stock editado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($stockproduct_id, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($stockproduct_id, $id)
    {

      $saleproduct = Saleproduct::find($id);

      $stockproduct = Stockproduct::find($stockproduct_id);

      $saleproductgroups = Saleproductgroup::orderBy('name', 'ASC')->pluck('name', 'id');

      return view('admin.saleproducts.edit', compact('saleproduct', 'stockproduct', 'saleproductgroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($stockproduct_id, Request $request, $id)
    {
      $saleproduct = Saleproduct::find($id);

      $saleproduct->fill($request->all())->save();

      return redirect()->route('stockproducts.saleproducts.edit', [$stockproduct_id, $saleproduct->id])
        ->with('info', 'Producto Stock editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($stockproduct_id, $id)
    {
        //
    }

    public function update_costo_eliminar($stockproduct_id, Request $request, $id)
    {
      $saleproduct = Saleproduct::find($id);

      $selectedItems = [];

      if($request->get('update_grupo'))
      {
        //Actualizo todo el grupo
        foreach ($saleproduct->saleproductgroup->saleproducts as $sp) {
          $sp->porc_min = $request->get('porc_min');
          $sp->porc_may = $request->get('porc_may');
          $sp->update();

          array_push($selectedItems, $sp->id);
        }
      }else {
        //Actualizo solo el stcokproduct que envie

        $saleproduct->porc_min = $request->get('porc_min');
        $saleproduct->porc_may = $request->get('porc_may');
        $saleproduct->update();

        array_push($selectedItems, $saleproduct->id);
      }

      //return redirect()->route('stockproducts.saleproducts.edit', [$stockproduct_id, $saleproduct->id])
        //->with('info', 'Producto Stock editado con éxito.');

      return redirect()->route('stockproducts.saleproducts.index', ['stockproduct_id' => 0, 'searchText' => $request->get('searchText'), 'selectedItems' => $selectedItems])
        ->with('info', 'Producto Stock modificado con éxito.');
    }

    public function update_valores(Request $request, $id)
    {
      $saleproduct = Saleproduct::find($id);

      $selectedItems = [];

      if($request->get('update_grupo'))
      {
        //Actualizo todo el grupo
        foreach ($saleproduct->saleproductgroup->saleproducts as $sp) {
          $sp->porc_min = $request->get('porc_min');
          $sp->porc_may = $request->get('porc_may');
          $sp->update();

          array_push($selectedItems, $sp->id);
        }
      }else {
        //Actualizo solo el stcokproduct que envie

        $saleproduct->porc_min = $request->get('porc_min');
        $saleproduct->porc_may = $request->get('porc_may');
        $saleproduct->update();

        array_push($selectedItems, $saleproduct->id);
      }

      //return redirect()->route('stockproducts.saleproducts.edit', [$stockproduct_id, $saleproduct->id])
        //->with('info', 'Producto Stock editado con éxito.');

      return redirect()->route('saleproducts.lista_de_precios', [ 'searchText' => $request->get('searchText'), 'selectedItems' => $selectedItems])
        ->with('info', 'Producto Stock modificado con éxito.');
    }

    public function lista_de_prddddecios($stockproduct_id = 0, Request $request)
    {

      $query = trim($request->get('searchText'));

      $val = explode(' ', $query );
      $atr = [];
      foreach ($val as $q) {
        array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
      };

      $selectedItems = [];

      if ($request->has('selectedItems')) {
        $selectedItems = $request->get('selectedItems');

      }


      $saleproducts = Saleproduct::orderBy('name', 'ASC')
        ->where($atr)
        ->paginate(15);

      return view('admin.saleproducts.lista_de_precios', ['saleproducts' => $saleproducts, 'searchText' => $query, 'selectedItems' => $selectedItems]);
    }
}
