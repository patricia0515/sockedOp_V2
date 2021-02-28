<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$est->no_documento}}">

	{{Form::Open(array('action'=>array('EstudianteController@destroy',$est->no_documento),'method'=>'delete'))}}
	
	<div class="modal-dialog">
		<div class="modal-content">


			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title">Eliminar Estudiante</h4>				
			</div>

			<div class="modal-body">
				<p>Confirme si desea Eliminar el estudiante</p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>				
			</div>


		</div>
	</div>

	{{Form::Close()}}
	
</div>
