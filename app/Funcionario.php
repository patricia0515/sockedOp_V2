<?php

namespace sockedOp;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table='funcionario';

    protected $primaryKey='id_funcionario';
	
	//Laravel puede automaticamente asignar a la tabla dos columnas, estas permitiran especificar cuando an sido creados u actualizados los registros: para este caso lo dejamos en false, ya que no lo necesitamos en esta ocación.
    public $timestamps=false;

    protected $fillable=[
		
		'id_funcionario',
	   	'tipo_documento',
	    'nombres',
	   	'apellidos',
	   	'celular',
	   	'direccion',
	   	'estado',
	  	'usuario'
	  	
    ];

    protected $guarded=[

    ];
}
