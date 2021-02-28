@extends('layouts.admin')
@section('contenido')

	<div class="row">
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		  <h3>Editar Estudiante: {{ $estudiante->nombres." ".$estudiante->apellidos}}</h3>
		  <!--Si encuentra errores que me los liste aqui en un div-->
		  @if (count($errors)>0)
		  <div class="alert alert-danger">
			  <ul>
			  @foreach ($errors->all() as $error)	
				  <li> {{$error}} </li>
			  @endforeach	
			  </ul>			
		  </div>
		  @endif
		</div>
	</div>
			
		  {!!Form::model($estudiante,['method'=>'PATCH','route'=>['escuela.estudiante.update',$estudiante->no_documento],'file'=>'true'])!!}
		  {{Form::token()}}

		<!--Aqui metemos una fila -->
	<div class="row">
		<!--1.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="from group">
				<label>Tipo de Documento</label>
				<select name="tipo_documento" required value="{{$estudiante->tipo_documento}}" class="form-control">
						@if ($estudiante->tipo_documento=='R.C')
							<option selected>R.C</option>
							<option>T.I</option>
							<option>C.C</option>
						@elseif ($estudiante->tipo_documento=='T.I')
							<option>R.C</option>
							<option selected>T.I</option>
							<option>C.C</option>
						@else ($estudiante->tipo_documento=='C.C')
							<option>R.C</option>
							<option>T.I</option>
							<option selected>C.C</option>
						@endif							
				</select>
			</div>
		</div>

		<!--2.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="no_documento">No. Documento</label>
		  		<input type="text" name="no_documento" required value="{{old('no_documento')}}" class="form-control" placeholder="Documento...">		  	
		    </div>
		</div>

		<!--3.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="nombres">Nombre</label>
		  		<input type="text" name="nombres" required value="{{$estudiante->nombres}}" class="form-control">		  	
		    </div>
		</div>

		<!--4.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="apellidos">Apellido</label>
		  		<input type="text" name="apellidos" required value="{{$estudiante->apellidos}}" class="form-control">		  	
		    </div>
		</div>

		<!--5.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="direccion">Dirección Residencia</label>
		  		<input type="text" name="direccion" required value="{{$estudiante->direccion}}" class="form-control">		  	
		    </div>
		</div>

		<!--6.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="barrio">Barrio</label>
		  		<input type="text" name="barrio" required value="{{$estudiante->barrio}}" class="form-control">  	
		    </div>
		</div>

		<!--7.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="celular">Celular</label>
		  		<input type="text" name="celular" required value="{{$estudiante->celular}}" class="form-control">  	
		    </div>
		</div>

		<!--8.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="email">Email</label>
		  		<input type="text" name="email" required value="{{$estudiante->email}}" class="form-control">  	
		    </div>
		</div>

		<!--9.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="from group">
				<label>Categoría</label>
				<select name="categoria" class="form-control">
					@foreach($categorias as $cat)
						@if ($cat->idcategoria==$estudiante->categoria)
						<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
						@else
						<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>

		<!--10.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="from group">
				<label>Entrenador</label>
				<select name="funcionario" class="form-control">
					@foreach($funcionarios as $fun)
						@if($fun->id_funcionario==$estudiante->funcionario)
						<option value="{{$fun->id_funcionario}}"seledted>{{$fun->nombres." ".$fun->apellidos}}</option>
						@else
						<option value="{{$fun->id_funcionario}}">{{$fun->nombres." ".$fun->apellidos}}</option>
						
						@endif
					@endforeach
				</select>
			</div>
		</div>

		<!--11.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="nombre_acudiente">Nombre Acudiente</label>
		  		<input type="text" name="nombre_acudiente" required value="{{$estudiante->nombre_acudiente}}" class="form-control">		  	
		    </div>
		</div>

		<!--12.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="apellidos_acudiente">Apellido Acudiente</label>
		  		<input type="text" name="apellidos_acudiente" required value="{{$estudiante->apellidos_acudiente}}" class="form-control">		  	
		    </div>
		</div>

		<!--13.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="tel_acudiente">Telefono Acudiente</label>
		  		<input type="text" name="tel_acudiente" required value="{{$estudiante->tel_acudiente}}" class="form-control">		  	
		    </div>
		</div>

		<!--14.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="email_acudiente">Email Acudiente</label>
		  		<input type="text" name="email_acudiente" required value="{{$estudiante->email_acudiente}}" class="form-control">		  	
		    </div>
		</div>

		<!--15.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="parentesco_acu">Parentesco</label>
		  		<input type="text" name="parentesco_acu" required value="{{$estudiante->parentesco_acu}}" class="form-control">		  	
		    </div>
		</div>

		<!--16.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="foto">Foto Tipo Documento</label>
		  		<input type="file" name="foto" class="form-control">
		  		@if($estudiante->foto!="")
		  			<img src="{{asset('imagenes/estudiantes/'.$estudiante->foto)}}" height="100px" width="100px" class="img-thumbnail">
		  		@endif		  	
		    </div>
		</div>
		
		<!--17.Aqui metemos una columna, Aqui ponemos os botones para la CRUD-->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
		  	   <button class="btn btn-primary" type="submit">Guardar</button>
		  	   <button class="btn btn-danger" type="reset">Cancelar</button>
	 	    </div>
	 	</div>
	</div>

		  {!!Form::close()!!}
@endsection
