<?php

namespace sockedOp;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table='estudiante';
    protected $primaryKey='no_documento';
	
	//Laravel puede automaticamente asignar a la tabla dos columnas, estas permitiran especificar cuando an sido creados u actualizados los registros: para este caso lo dejamos en false, ya que no lo necesitamos en esta ocación. 
    public $timestamps=false;

    protected $fillable=[
		
    	'no_documento',
    	'tipo_documento',
    	'nombres',
    	'apellidos',
    	'direccion',
    	'barrio',
    	'celular',
    	'email',
    	'estado',
    	'nombre_acudiente',
    	'apellidos_acudiente',
    	'tel_acudiente',
    	'email_acudiente',
    	'parentesco_acu',
    	'funcionario',
    	'categoria',
        'foto'
    ];

    protected $guarded=[

    ];
}
