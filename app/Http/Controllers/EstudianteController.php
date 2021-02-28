<?php

namespace sockedOp\Http\Controllers;

use Illuminate\Http\Request;

use sockedOp\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sockedOp\Http\Requests\EstudianteFormRequest;
use sockedOp\Estudiante;
use DB;



class EstudianteController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$estudiante=DB::table('estudiante as e')
    		//Aqui relacionamos las foraneas y los campos de cada tabla que son el mismo
    		->join('categoria as c','e.categoria','=','c.idcategoria')
    		->join('funcionario as f','e.funcionario','=','f.id_funcionario')
			->join('usuario as u','u.doc_usuario','=','f.usuario')

    		//Aqui seleccionamos los campos que queremos mostrar en la vista estudiante
    		->select('e.no_documento','e.nombres','e.apellidos', 'c.nombre as categoria', 'f.nombres as n_entrenador' , 'f.apellidos as a_entrenador','e.foto','e.estado')

            //Aqui le digo por que campos filtrar busqueda
    		->where('e.nombres','LIKE','%'.$query.'%')
            ->orwhere('e.apellidos','LIKE','%'.$query.'%')
            ->orwhere('e.no_documento','LIKE','%'.$query.'%')
            ->orderBy('e.no_documento','desc')
    		->paginate(7);
    		return view('escuela.estudiante.index',["estudiantes"=>$estudiante,"searchText"=>$query]);
    	}	
}
public function create()
    {
		//Me trae en la variable $categorias todos los registros de la tabla categoria
        //con la condición 1
    	$categorias=DB::table('categoria')
        	->where('condicion','=','1')
        	->get();
        //Me trae en la variable $funcionarios, todos los registros de la tabla funcionario
        //con estado Activo
        $funcionarios=DB::table('funcionario as f')
			->join('usuario as u','u.doc_usuario','=','f.usuario')
			->select('f.nombres as Nombre','f.apellidos as Apellido','f.id_funcionario','tipo_usuario')
        	->where('estado','=','Activo')
			->where('tipo_usuario','=','Entrenador')
			->orderBy('f.id_funcionario','desc')		
        	->get();
        //al final me retorna estas 3 variables por parametros en arreglos
    	return view("escuela.estudiante.create",["categorias"=>$categorias,"funcionarios"=>$funcionarios]);

    }

    public function store(EstudianteFormRequest $request)
    {
    	//Creamos el Objeto
        $estudiante=new Estudiante;

        //Le damos los atributos        
        $estudiante->no_documento=$request->get('no_documento');
    	$estudiante->tipo_documento=$request->get('tipo_documento');
    	$estudiante->nombres=$request->get('nombres');
    	$estudiante->apellidos=$request->get('apellidos');
		$estudiante->estado='Activo';
    	$estudiante->direccion=$request->get('direccion');
    	$estudiante->barrio=$request->get('barrio');
    	$estudiante->celular=$request->get('celular');
    	$estudiante->email=$request->get('email');
    	$estudiante->nombre_acudiente=$request->get('nombre_acudiente');
    	$estudiante->apellidos_acudiente=$request->get('apellidos_acudiente');
        $estudiante->tel_acudiente=$request->get('tel_acudiente');
        $estudiante->email_acudiente=$request->get('email_acudiente');
        $estudiante->parentesco_acu=$request->get('parentesco_acu');
        $estudiante->funcionario=$request->get('funcionario');
		$estudiante->categoria=$request->get('categoria');
        
        /*Pilas a esta novedad*/
        

        if(Input::hasfile('foto')){
            $file=Input::file('foto');
            $file->move(public_path().'/imagenes/estudiantes/',$file->getClientOriginalName());
            $estudiante->foto=$file->getClientOriginalName();
        }
    	$estudiante->save();
    	return Redirect::to('escuela/estudiante');
    }

    public function show($id)
    {
    	return view("escuela.estudiante.show",["estudiante"=>Estudiante::findOrFail($id)]);
    }

    public function edit ($id)
    {
    	$estudiante=Estudiante::findOrFail($id);
		
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
        $funcionarios=DB::table('funcionario')->where('estado','=','Activo')->get();
        

    	return view("escuela.estudiante.edit",["estudiante"=>$estudiante,"categorias"=>$categorias,"funcionarios"=>$funcionarios]);

    }

    public function update(EstudianteFormRequest $request,$id)
    {
        //definimos el objeto 
    	$estudiante=Estudiante::findOrFail($id);
        //Le damos los atributos
        
        $estudiante->no_documento=$request->get('no_documento');
        $estudiante->tipo_documento=$request->get('tipo_documento');
        $estudiante->nombres=$request->get('nombres');
        $estudiante->apellidos=$request->get('apellidos');
        $estudiante->direccion=$request->get('direccion');
        $estudiante->barrio=$request->get('barrio');
        $estudiante->celular=$request->get('celular');
        $estudiante->email=$request->get('email');
        $estudiante->nombre_acudiente=$request->get('nombre_acudiente');
        $estudiante->apellidos_acudiente=$request->get('apellidos_acudiente');
        $estudiante->tel_acudiente=$request->get('tel_acudiente');
        $estudiante->email_acudiente=$request->get('email_acudiente');
        $estudiante->parentesco_acu=$request->get('parentesco_acu');
        $estudiante->funcionario=$request->get('funcionario');
		$estudiante->categoria=$request->get('categoria');
        

        if(Input::hasfile('foto')){
            $file=Input::file('foto');
            $file->move(public_path().'/imagenes/estudiantes/',$file->getClientOriginalName());
            $estudiante->foto=$file->getClientOriginalName();
        }

    	$estudiante->update();
    	return Redirect::to('escuela/estudiante');
    }

    public function destroy($id)
    {
    	$estudiante=Estudiante::findOrFail($id);
    	$estudiante->estado='Inactivo';
		
        $estudiante->update();//cambia el estado en la base de datos, para eliminar de BD se cambia por delete en vez de update
    	return Redirect::to('escuela/estudiante');
    }

}

