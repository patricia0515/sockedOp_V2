<?php

namespace sockedOp\Http\Controllers;

use Illuminate\Http\Request;

use sockedOp\Http\Requests;
use sockedOp\Categoria;
use Illuminate\Support\Facades\Redirect;
use sockedOp\Http\Requests\CategoriaFormRequest;
use DB;

//Aqui encontramos las funciones de la CRUD
class CategoriaController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$categorias=DB::table('categoria')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orderBy('idcategoria','desc')
            ->paginate(7);
            
    		 return view('escuela.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
    	}

    }

    public function create()
    {
    	return view("escuela.categoria.create");

    }

    public function store(CategoriaFormRequest $request)
    {
    	$categoria=new Categoria;
    	$categoria->nombre=$request->get('nombre');
    	$categoria->descripcion=$request->get('descripcion');
    	$categoria->condicion='1';
    	$categoria->save();
    	return Redirect::to('escuela/categoria');
    }

    public function show($id)
    {
    	return view("escuela.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    public function edit ($id)
    {
    	return view("escuela.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);

    }

    public function update(CategoriaFormRequest $request,$id)
    {
    	$categoria=Categoria::findOrFail($id);
    	$categoria->nombre=$request->get('nombre');
    	$categoria->descripcion=$request->get('descripcion');
    	$categoria->update();
    	return Redirect::to('escuela/categoria');
    }

    public function destroy($id)
    {
    	$categoria=Categoria::findOrFail($id);
    	$categoria->condicion='0';
        $categoria->update();//cambia la condicion en la base de datos, para eliminar de BD se cambia por delete en vez de update
    	return Redirect::to('escuela/categoria');
    }

}
