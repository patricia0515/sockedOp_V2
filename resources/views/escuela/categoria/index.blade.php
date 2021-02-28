@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Categorías <a href="categoria/create"> <button class="btn btn-success">Nuevo</button></a></h3>
		<!--Le voy a decir que llame a la vista search ubicada en la carpeta categoria de las views-->
		@include ('escuela.categoria.search')		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead><!--Esta es la cabecera de la tabla con los campos tipulos -->
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
				<!--Este bucle va recorrear todas las categorias y las va a almacenar en la variable $cap de manera independiente y se ira mostrando en las filas-->
				@foreach ($categorias as $cat)
				 <tr>
					 <td>{{ $cat -> idcategoria }}</td>
					 <td>{{ $cat -> nombre }}</td>
					 <td>{{ $cat -> descripcion }}</td>
					 <td>
						 <a href=" {{URL::action('CategoriaController@edit',$cat->idcategoria)}}"><button class="btn btn-info">Editar</button></a>
						 <a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					 </td>
				 </tr>
				@include('escuela.categoria.modal')
				@endforeach 
			</table>			
		</div>	
		<!--Gracias al metodo render () podemos paguinar los datos-->
		{{ $categorias -> render() }}	
	</div>
</div>

@endsection
