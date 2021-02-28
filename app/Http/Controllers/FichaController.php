<?php

namespace sockedOp\Http\Controllers;

use Illuminate\Http\Request;

use sockedOp\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

//Hacemos uso de nuestro documento de validación Request.
use sockedOp\Http\Requests\FichaFormRequest;

//Referenciamos los Modelos que necesitamos.
use sockedOp\Estudiante;
use sockedOp\Ficha_tecnica;

//Se pones esta función para poder utilizar algunas funciones de Base de Datos.
use DB;

//Para poder utilizar el formato de hora y fecha de nuestra zona horaria.

use Response;
use Carbon\Carbon;

class FichaController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
    	if ($request)
    	{
			//La función trim es para quitar los espacios tanto al inicio como al final.
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
    		return view('escuela.ficha.index',["estudiantes"=>$estudiante,"searchText"=>$query]);
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
    	return view("escuela.ficha.create",["categorias"=>$categorias,"funcionarios"=>$funcionarios]);

    }
	
	public function store(FichaFormRequest $request)
    {
		//Inicialmente vamos a declarar un capturador de excepciónes un try/catch
		
		try{
			//Iniciamos la transacción, porque se almacena primero los datos de la tabla estudiante y despues los de la tabla ficha_tecnica, pero si por alguna razón hay un problema en el sistema "luz, internet, la red, etc." y solamente se almacenen los datos en la tabla estudiante entonces la transacción no va a ser efectiva. 
			DB::beginTransaction();
			
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

        if(Input::hasfile('foto')){
            $file=Input::file('foto');
            $file->move(public_path().'/imagenes/estudiantes/',$file->getClientOriginalName());
            $estudiante->foto=$file->getClientOriginalName();
        }
			$estudiante->save();
			
			$ficha=new Ficha_tecnica;
			
			$mytime=Carbon::now('America/Bogota');
			$ficha->fecha_nacimiento=$request->get('fecha_nacimiento');
			$ficha->rh=$request->get('rh');
			//$ficha->edad=Carbon::parse(fecha_nacimiento)->age;
			//dump"$edad"
			$ficha->eps=$request->get('eps');
			$ficha->estatura=$request->get('estatura');
			$ficha->peso=$request->get('peso');
			$ficha->talla=$request->get('talla');
			$ficha->n_calzada=$request->get('n_calzada');
			$ficha->posicion=$request->get('posicion');
			$ficha->club_otro=$request->get('club_otro');
			$ficha->estudiante=$request->get('no_documento');
			$ficha->save();
			//Aqui finalizo la transacción.
			DB::commit();			
		}
		//El catch rastrea si hay alguna excepción en la transacción, se ser asi por medio del rollBack la anula.
		catch(\Exception $e)
		{
			DB::rollBack();
		}
		return Redirect::to('escuela/ficha');
		
    }
	
	public function show ($id)
	{
		$estudiante=DB::table('estudiante as e')
			->join('categoria as c','e.categoria','=','c.idcategoria')
    		->join('funcionario as f','e.funcionario','=','f.id_funcionario')
			->join('usuario as u','u.doc_usuario','=','f.usuario')
			->join('ficha_tecnica as ft','e.no_documento','=','ft.estudiante')
			//Aqui seleccionamos los campos que queremos mostrar en la vista detalles estudiante\ficha
			->select(			
			'e.no_documento',
			'e.tipo_documento',
			'e.nombres',
			'e.apellidos',
			'e.direccion',
			'e.barrio',
			'e.celular',
			'e.email',
			'e.estado',
			'e.nombre_acudiente',
			'e.apellidos_acudiente',
			'e.tel_acudiente',
			'e.email_acudiente',
			'e.parentesco_acu',
			'f.nombres',
			'f.apellidos',
			'c.categoria',
			'e.foto',
			'ft.fecha_nacimiento',
			'ft.rh',
			'ft.edad',
			'ft.eps',
			'ft.estatura',
			'ft.peso',
			'ft.talla',
			'ft.n_calzada',
			'ft.posicion',
			'ft.estudiante',
			'ft.club_otro')		
			->where('e.no_documento','=',$id)
			->get();
		
		return view('escuela.ficha.show',["estudiante"=>$estudiante]);		
	}
	public function edit ($id)
    {
    	$estudiante=Estudiante::findOrFail($id);
		
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
        $funcionarios=DB::table('funcionario')->where('estado','=','Activo')->get();
		$fichas=DB::table('ficha_tecnica')->where('estudiante.no_documento','=','ficha_tecnica.estudiante')->get();
        

    	return view("escuela.ficha.edit",["estudiante"=>$estudiante,"categorias"=>$categorias,"funcionarios"=>$funcionarios,"fichas"=>$fichas]);

    }

    public function update(FichaFormRequest $request,$id)
    {
		//Inicialmente vamos a declarar un capturador de excepciónes un try/catch
		
		try{
			//Iniciamos la transacción, porque se almacena primero los datos de la tabla estudiante y despues los de la tabla ficha_tecnica, pero si por alguna razón hay un problema en el sistema "luz, internet, la red, etc." y solamente se almacenen los datos en la tabla estudiante entonces la transacción no va a ser efectiva. 
			DB::beginTransaction();
			//Instanciamos el objeto
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
        
			if(Input::hasfile('foto')){
				$file=Input::file('foto');
				$file->move(public_path().'/imagenes/estudiantes/',$file->getClientOriginalName());
				$estudiante->foto=$file->getClientOriginalName();
			}
			$estudiante->update();
			
			$ficha=new Ficha_tecnica;			
			$mytime=Carbon::now('America/Bogota');
			$ficha->fecha_nacimiento=$request->get('fecha_nacimiento');
			$ficha->rh=$request->get('rh');
			//$ficha->edad=Carbon::parse(fecha_nacimiento)->age;
			//dump"$edad"
			$ficha->eps=$request->get('eps');
			$ficha->estatura=$request->get('estatura');
			$ficha->peso=$request->get('peso');
			$ficha->talla=$request->get('talla');
			$ficha->n_calzada=$request->get('n_calzada');
			$ficha->posicion=$request->get('posicion');
			$ficha->club_otro=$request->get('club_otro');
			$ficha->estudiante=$request->get('no_documento');
			$ficha->update();			
			//Aqui finalizo la transacción.
			DB::commit();			
		}
		//El catch rastrea si hay alguna excepción en la transacción, se ser asi por medio del rollBack la anula.
		catch(\Exception $e)
		{
			DB::rollBack();
		}
    	return Redirect::to('escuela/ficha');
    }
	public function destroy($id)
    {
    	$estudiante=Estudiante::findOrFail($id);
    	$estudiante->estado='Inactivo';
		
        $estudiante->update();//cambia el estado en la base de datos, para eliminar de BD se cambia por delete en vez de update
    	return Redirect::to('escuela/ficha');
    }
}
