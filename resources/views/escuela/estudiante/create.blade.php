@extends('layouts.admin')
@section('contenido')
	<div class="row">
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		  <h3>Nuevo Estudiante</h3>
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

			<!--Iniciamos el formulario -->
		  {!!Form::open(array('url'=>'escuela/estudiante','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
		  {{Form::token()}}

	<!--Aqui metemos una fila -->
	<div class="row">
		<!--
		<div class="box-header with-border">
            <h4> Datos Personales</h4>
        </div>
        -->

		<!--1.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="from group">
				<label>Tipo de Documento</label>
				<select name="tipo_documento" required value="{{old('tipo_documento')}}" class="form-control">
						<option disabled selected>Seleccione una opción</option>
						<option>R.C</option>
						<option>T.I</option>
						<option>C.C</option>							
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
		  		<input type="text" name="nombres" required value="{{old('nombres')}}" class="form-control" placeholder="Nombre...">		  	
		    </div>
		</div>

		<!--4.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="apellidos">Apellido</label>
		  		<input type="text" name="apellidos" required value="{{old('apellidos')}}" class="form-control" placeholder="Apellido...">		  	
		    </div>
		</div>

		<!--5.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="direccion">Dirección Residencia</label>
		  		<input type="text" name="direccion" required value="{{old('direccion')}}" class="form-control" placeholder="Dirección...">		  	
		    </div>
		</div>

		<!--6.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="barrio">Barrio</label>
		  		<input type="text" name="barrio" required value="{{old('barrio')}}" class="form-control" placeholder="Barrio...">  	
		    </div>
		</div>

		<!--7.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="celular">Celular</label>
		  		<input type="text" name="celular" required value="{{old('celular')}}" class="form-control" placeholder="No. Celular...">  	
		    </div>
		</div>

		<!--8.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="email">Email</label>
		  		<input type="text" name="email" required value="{{old('email')}}" class="form-control" placeholder="Correo Electronico...">  	
		    </div>
		</div>

		<!--9.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="from group">
				<label>Categoría</label>
				<select name="categoria" class="form-control selectpicker" data-live-search="true">
					<option disabled selected>Seleccione una Categoría<option>
					@foreach($categorias as $cat)
						<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<!--10.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="from group">
				<label>Entrenador</label>
				<select name="funcionario" class="form-control selectpicker" data-live-search="true">
					<option disabled selected>Seleccione Entrenador<option>
					@foreach($funcionarios as $fun)
						<option value="{{$fun->id_funcionario}}">{{$fun->Nombre." ".$fun->Apellido}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<!--
		<div class="box-header with-border">
            <h4>Datos Familiares</h4>
        </div>
    	-->

		<!--11.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="nombre_acudiente">Nombre Acudiente</label>
		  		<input type="text" name="nombre_acudiente" required value="{{old('nombre_acudiente')}}" class="form-control" placeholder="Nombres Acudiente...">		  	
		    </div>
		</div>

		<!--12.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="apellidos_acudiente">Apellido Acudiente</label>
		  		<input type="text" name="apellidos_acudiente" required value="{{old('apellidos_acudiente')}}" class="form-control" placeholder="Apellidos Acudiente...">		  	
		    </div>
		</div>

		<!--13.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="tel_acudiente">Telefono Acudiente</label>
		  		<input type="text" name="tel_acudiente" required value="{{old('tel_acudiente')}}" class="form-control" placeholder="Número de contacto...">		  	
		    </div>
		</div>

		<!--14.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="email_acudiente">Email Acudiente</label>
		  		<input type="text" name="email_acudiente" required value="{{old('email_acudiente')}}" class="form-control" placeholder="Correo Electronico...">		  	
		    </div>
		</div>

		<!--15.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="parentesco_acu">Parentesco</label>
		  		<input type="text" name="parentesco_acu" required value="{{old('parentesco_acu')}}" class="form-control" placeholder="Parentesco con el estudiante...">		  	
		    </div>
		</div>

		<!--16.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="foto">Foto Tipo Documento</label>
		  		<input type="file" name="foto" class="form-control">		  	
		    </div>
		</div>
		
		<!--17.Aqui metemos una columna, Aqui ponemos os botones para la CRUD -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
		  	   <button class="btn btn-primary" type="submit">Guardar</button>
		  	   <button class="btn btn-danger" type="reset">Cancelar</button>
	 	    </div>
	 	</div>
	</div>


		  {!!Form::close()!!}

@endsection
