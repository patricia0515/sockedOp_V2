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
		  {!!Form::open(array('url'=>'escuela/ficha','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
		  {{Form::token()}}

			<!--Aqui metemos una fila -->
			<div class="row">
	
				<!-- Datos Personales-->
				
				<!--1.Aqui metemos una columna -->
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
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
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="no_documento">No. Documento</label>
						<input type="text" name="no_documento" required value="{{old('no_documento')}}" class="form-control" placeholder="Documento...">		  	
					</div>
				</div>

				<!--2.Aqui metemos una columna -->		
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="fecha_nacimiento">Fecha de Nacimiento</label>
						<input type="date" name="fecha_nacimiento" required value="{{old('fecha_nacimiento')}}" class="form-control" placeholder="Fecha de nacimiento...">		  	
					</div>
				</div>

				<!--3.Aqui metemos una columna -->
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="nombres">Nombre</label>
						<input type="text" name="nombres" required value="{{old('nombres')}}" class="form-control" placeholder="Nombre...">		  	
					</div>
				</div>

				<!--4.Aqui metemos una columna -->
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="apellidos">Apellido</label>
						<input type="text" name="apellidos" required value="{{old('apellidos')}}" class="form-control" placeholder="Apellido...">		  	
					</div>
				</div>

				<!--16.Aqui metemos una columna -->
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="foto">Foto Tipo Documento</label>
						<input type="file" name="foto" class="form-control">		  	
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
			</div><!--Aqui cierra mi primera fila-->

		<p><!--Este parrafo es porque me estaba quedando muy montado los datos del estudiante con los del acudiente--></p>
    	
		
	<div class="row"><!--Aqui inicia la segunda fila-->
		<!-- A partir de aqui pongo los input para llenar la tabla ficha_tecnica -->
		<div class="panel panel-primary">
	 	<div class="panel-body">
	 	
	 	<!--17.Aqui metemos una columna -->
	 	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
		  		<label for="rh">RH</label>
		  		<input type="text" name="rh" required value="{{old('rh')}}" class="form-control" placeholder="Grupo sanguineo...">		  	
		    </div>
		</div>

		<!--18.Aqui metemos una columna -->
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
		  		<label for="eps">EPS</label>
		  		<input type="text" name="eps" required value="{{old('eps')}}" class="form-control" placeholder="Sistema de Salud...">		  	
		    </div>
		</div>

		<!--19.Aqui metemos una columna -->
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
		  		<label for="estatura">Estatura</label>
		  		<input type="text" name="estatura" required value="{{old('estatura')}}" class="form-control" placeholder="Estatura...">		  	
		    </div>
		</div>

		<!--20.Aqui metemos una columna -->
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
		  		<label for="peso">Peso</label>
		  		<input type="text" name="peso" required value="{{old('peso')}}" class="form-control" placeholder="Peso...">		  	
		    </div>
		</div>

		<!--21.Aqui metemos una columna -->
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
		  		<label for="talla">Talla</label>
		  		<input type="text" name="talla" required value="{{old('talla')}}" class="form-control" placeholder="Talla...">  	
		    </div>
		</div>

		<!--22.Aqui metemos una columna -->
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
		  		<label for="n_calzada">Talla de pie</label>
		  		<input type="text" name="n_calzada" required value="{{old('n_calzada')}}" class="form-control" placeholder="N° Calzado...">  	
		    </div>
		</div>

		<!--23.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="posicion">Posición en la cancha</label>
		  		<input type="text" name="posicion" required value="{{old('posicion')}}" class="form-control" placeholder="Posición...">  	
		    </div>
		</div>
		<!--24.Aqui metemos una columna -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
		  		<label for="club_otro">Club</label>
		  		<input type="text" name="club_otro" required value="{{old('club_otro')}}" class="form-control" placeholder="Si a pertenecido a otro club relacionelo...">  	
		    </div>
		</div>
	
			
	 	</div>
	 </div>
		
		 
	</div><!--.Aqui cierra mi fila 2 -->
		
	<div class="row"><!--15.Aqui Abre mi fila 3-->
	<!-- A partir de aqui pongo los input para llenar la tabla ficha_tecnica -->
	 <div class="panel panel-primary">
			<div class="panel-body">

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
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label for="tel_acudiente">Telefono Acudiente</label>
					<input type="text" name="tel_acudiente" required value="{{old('tel_acudiente')}}" class="form-control" placeholder="Número de contacto...">		  	
				</div>
			</div>

			<!--14.Aqui metemos una columna -->
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label for="email_acudiente">Email Acudiente</label>
					<input type="text" name="email_acudiente" required value="{{old('email_acudiente')}}" class="form-control" placeholder="Correo Electronico...">		  	
				</div>
			</div>

			<!--15.Aqui metemos una columna -->
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label for="parentesco_acu">Parentesco</label>
					<input type="text" name="parentesco_acu" required value="{{old('parentesco_acu')}}" class="form-control" placeholder="Parentesco con el estudiante...">		  	
				</div>
			</div>
			
		  </div><!-- Cierre de class=panel-body -->
		</div><!-- Cierre del class=panel panel-primary -->
	 
	 <!--17.Aqui metemos una columna, Aqui ponemos los botones para la CRUD -->
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				  <button class="btn btn-primary" type="submit">Guardar</button>
				  <button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>
	


		  {!!Form::close()!!}

@endsection
