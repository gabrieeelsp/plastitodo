<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreFormRequest;
use App\Http\Requests\CategoryUpdateFormRequest;
use App\Http\Controllers\Controller;

use App\Category;
use App\Rubro;

class CategoryController extends Controller
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

        $categories = Category::orderBy('name', 'ASC')
          ->where($atr)
          ->paginate(10);

        return view('admin.categories.index', ['categories' => $categories, 'searchText' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rubros = Rubro::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.categories.create', compact('rubros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreFormRequest $request)
    {
        $category = Category::create($request->all());

        return redirect()->route('categories.edit', $category->id)
          ->with('info', 'Categoria creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rubros = Rubro::orderBy('name', 'ASC')->pluck('name', 'id');
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category', 'rubros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateFormRequest $request, $id)
    {
        $category = Category::find($id);

        $category->fill($request->all())->save();

        return redirect()->route('categories.edit', $category->id)
          ->with('info', 'Categoria editada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente.');
    }
}
