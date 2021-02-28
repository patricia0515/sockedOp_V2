@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Estudiantes<a href="ficha/create"> <button class="btn btn-success">Nuevo</button></a></h3>
		<!--Le voy a decir que llame a la vista search ubicada en la carpeta ficha de las views-->
		@include ('escuela.ficha.search')		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead><!--Esta es la cabecera de la tabla con los campos tipulos -->
					<th>No. Documento</th>
					<th>Nombres</th>
					<th>Categoría</th>
					<th>Foto</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				<!--Este bucle va recorrear todas los estudiantes, los va a almacenar en la variable $est de manera independiente y se ira mostrando en las filas-->
				@foreach ($estudiantes as $est)
				 <tr>
					 <td>{{ $est -> no_documento}}</td>
					 <td>{{ $est -> nombres." ".$est -> apellidos }}</td>
					 <td>{{ $est -> categoria }}</td>
					 <td>
					 	<img src="{{asset('imagenes/estudiantes/'.$est->foto)}}" alt="{{$est->nombres}}" height="50px" width="50px" class="img-thumbnail">
					 </td>
					 <td>{{ $est -> estado }}</td>


					 <td>
						 <a href=" {{URL::action('FichaController@show',$est->no_documento)}}"><button class="btn btn-primary">Detalles</button></a>
						 <a href="" data-target="#modal-delete-{{$est->no_documento}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					 </td>
				 </tr>
				@include('escuela.ficha.modal')
				@endforeach 
			</table>			
		</div>	
		<!--Gracias al metodo render () podemos paginar los datos-->
		{{$estudiantes->render()}}	
	</div>
</div>

@endsection
