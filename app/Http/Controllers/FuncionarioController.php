<?php

namespace sockedOp\Http\Controllers;

use Illuminate\Http\Request;

use sockedOp\Http\Requests;

class FuncionarioController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
			
    		$funcionarios=DB::table('funcionario as f')
			//Aqui relacionamos las foraneas y los campos de cada tabla que son el mismo
    		->join('usuario as u','f.usuario','=','u.doc_usuario')
    		
    		//Aqui seleccionamos los campos que queremos mostrar en la vista estudiante
    		->select('f.id_funcionario as ID', 'u.doc_usuario as Cedula','f.nombres as Nombre','f.apellidos as Apellido', 'u.clave_usuario as Clave', 'u.mail_usuario as Mail' , 'u.tipo_usuario as Cargo')

            //Aqui le digo por que campos filtrar busqueda
    		->where('f.Nombre','LIKE','%'.$query.'%')
            ->orwhere('f.Apellido','LIKE','%'.$query.'%')
            ->orwhere('u.Cedula','LIKE','%'.$query.'%')
            ->orderBy('f.ID','desc')
    		->paginate(7);
			
    		return view('escuela.funcionario.index',["funcionarios"=>$funcionarios,"searchText"=>$query]);
    	}	
}
public function create()
    {
        //Me trae en la variable $categorias todos los registros de la tabla categoria
        //con la condición 1
    	$usuarios=DB::table('usuario')
		->where('tipo_persona','=','Entrenador')
        ->get();

        //al final me retorna estas 3 variables por parametros en arreglos
    	return view("escuela.funcionario.create",["usuarios"=>$usuarios]);

    }

    public function store(FuncionarioFormRequest $request)
    {
    	//Creamos el Objeto
        $funcionario=new Funcionario;
        //Le damos los atributos
        
        $funcionario->tipo_documento=$request->get('tipo_documento');
    	$funcionario->nombres=$request->get('nombres');
    	$funcionario->apellidos=$request->get('apellidos');
		$funcionario->celular=$request->get('celular');
    	$funcionario->direccion=$request->get('direccion');
    	$funcionario->estado='Activo';
		$funcionario->usuario='1024463821';
        
    	$funcionario->save();
    	return Redirect::to('escuela/funcionario');
    }

    public function show($id)
    {
    	return view("escuela.funcionario.show",["estudiante"=>Estudiante::findOrFail($id)]);
    }

    public function edit ($id)
    {
    	$funcionario=Funcionario::findOrFail($id);
		
        $Usuarios=DB::table('usuario')->where('estado','=','Activo')->get();
        

    	return view("escuela.funcionario.edit",["funcionarios"=>$funcionario,"usuarios"=>$usuarios]);

    }

    public function update(EstudianteFormRequest $request,$id)
    {
        //Creamos el Objeto
        $funcionario=new Funcionario;
        //Le damos los atributos
        
        $funcionario->tipo_documento=$request->get('tipo_documento');
    	$funcionario->nombres=$request->get('nombres');
    	$funcionario->apellidos=$request->get('apellidos');
		$funcionario->celular=$request->get('celular');
    	$funcionario->direccion=$request->get('direccion');
    	$funcionario->estado='Activo';
		$funcionario->usuario='1024463821';
        
    	$funcionario->save();
    	return Redirect::to('escuela/funcionario');
        
    }

    public function destroy($id)
    {
		$funcionario=Funcionario::findOrFail($id);
    	$funcionario->estado='Inactivo';
		
        $funcionario->update();//cambia el estado en la base de datos, para eliminar de BD se cambia por delete en vez de update
    	return Redirect::to('escuela/funcionario');
    }
}
