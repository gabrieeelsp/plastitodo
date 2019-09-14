<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StockproductStoreFormRequest;
use App\Http\Requests\StockproductUpdateFormRequest;
use App\Http\Controllers\Controller;

use App\Stockproduct;
use App\Category;
use App\Stockproductgroup;

class StockproductController extends Controller
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
      $query = trim($request->get('searchText'));

      $val = explode(' ', $query );
      $atr = [];
      foreach ($val as $q) {
        array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
      };

      $stockproducts = Stockproduct::orderBy('name', 'ASC')
        ->where($atr)
        ->paginate(10);

        $selectedItems = [];

        if ($request->has('selectedItems')) {
          $selectedItems = $request->get('selectedItems');

        }


        return view('admin.stockproducts.index', ['stockproducts' => $stockproducts, 'searchText' => $query, 'selectedItems' => $selectedItems]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        $stockproductgroups = Stockproductgroup::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.stockproducts.create', compact('categories', 'stockproductgroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockproductStoreFormRequest $request)
    {
        $stockproduct = Stockproduct::create($request->all());

        return redirect()->route('stockproducts.edit', $stockproduct->id)
          ->with('info', 'Producto Stock creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stockproduct = Stockproduct::find($id);

        return view('admin.stockproducts.show', compact('stockproduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        $stockproductgroups = Stockproductgroup::orderBy('name', 'ASC')->pluck('name', 'id');

        $stockproduct = Stockproduct::find($id);

        return view('admin.stockproducts.edit', compact('stockproduct', 'categories', 'stockproductgroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StockProductUpdateFormRequest $request, $id)
    {
        $stockproduct = Stockproduct::find($id);

        $stockproduct->fill($request->all())->save();

        return redirect()->route('stockproducts.edit', $stockproduct->id)
          ->with('info', 'Producto Stock editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stockproduct::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente.');
    }

    public function lista_deposito(Request $request)
    {
      $query = trim($request->get('searchText'));

      $val = explode(' ', $query );
      $atr = [];
      foreach ($val as $q) {
        array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
      };

        $stockproducts = Stockproduct::orderBy('name', 'ASC')
          ->where($atr)
          ->where('stock', '<>', 0)
          ->paginate(10);

        return view('admin.deposito.lista_deposito', ['stockproducts' => $stockproducts, 'searchText' => $query]);
    }

    public function update_costo(Request $request, $id)
    {
      $stockproduct = Stockproduct::find($id);

      $selectedItems = [];

      if($request->get('update_grupo'))
      {
        //Actualizo todo el grupo
        //dd($stockproduct->stockproductgroup->stockproducts);
        foreach ($stockproduct->stockproductgroup->stockproducts as $sp) {
          $sp->costo = $request->get('costo');
          $sp->update();

          array_push($selectedItems, $sp->id);
        }
      }else {
        //Actualizo solo el stcokproduct que envie

        $stockproduct->costo = $request->get('costo');
        $stockproduct->update();

        array_push($selectedItems, $stockproduct->id);
      }



      return redirect()->route('stockproducts.index', ['searchText' => $request->get('searchText'), 'selectedItems' => $selectedItems])
        ->with('info', 'Producto Stock modificado con éxito.');
    }

    public function existencias(Request $request)
    {
      $query = trim($request->get('searchText'));

      $val = explode(' ', $query );
      $atr = [];
      foreach ($val as $q) {
        array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
      };

      $stockproducts = Stockproduct::orderBy('name', 'ASC')
        ->where($atr)
        ->where('stock', '!=', '0')
        ->paginate(10);

        $selectedItems = [];

        if ($request->has('selectedItems')) {
          $selectedItems = $request->get('selectedItems');

        }


        return view('admin.stockproducts.existencias', ['stockproducts' => $stockproducts, 'searchText' => $query, 'selectedItems' => $selectedItems]);
    }
}
