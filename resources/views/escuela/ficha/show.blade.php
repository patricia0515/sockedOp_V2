@extends('layouts.admin')
@section('contenido')
			
			<!--Aqui metemos una fila -->
			<div class="row">
	
				<!-- Datos Personales-->
				
				<!--1.Aqui metemos una columna -->
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="from group">
						<label>Tipo de Documento</label>
						<p>{{$estudiantes -> no_documento}}</p>
					</div>
				</div>

	
	</div>
	
@endsection
