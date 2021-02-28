{!!Form::open(array('url'=>'escuela/ficha','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="input-group">
	<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}" >
	<spam class="input-group-btn">
		<button type="sumit" class="btn btn-primary">Buscar</button>
	</spam>
</div>

{{Form::close()}}