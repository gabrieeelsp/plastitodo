<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RubroStoreFormRequest;
use App\Http\Requests\RubroUpdateFormRequest;
use App\Http\Controllers\Controller;

use App\Rubro;

class RubroController extends Controller
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

        $rubros = Rubro::orderBy('name', 'ASC')
          ->where($atr)
          ->paginate(10);

        return view('admin.rubros.index', ['rubros' => $rubros, 'searchText' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rubros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RubroStoreFormRequest $request)
    {
        $rubro = Rubro::create($request->all());

        return redirect()->route('rubros.edit', $rubro->id)
          ->with('info', 'Rubro creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rubro = Rubro::find($id);

        return view('admin.rubros.show', compact('rubro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rubro = Rubro::find($id);

        return view('admin.rubros.edit', compact('rubro'));
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
        $rubro = Rubro::find($id);

        $rubro->fill($request->all())->save();

        return redirect()->route('rubros.edit', $rubro->id)
          ->with('info', 'Rubro editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rubro::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}
