<?php

namespace sockedOp;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuario';

    protected $primaryKey='doc_usuario';
	
	//Laravel puede automaticamente asignar a la tabla dos columnas, estas permitiran especificar cuando an sido creados u actualizados los registros: para este caso lo dejamos en false, ya que no lo necesitamos en esta ocación.
    public $timestamps=false;

    protected $fillable=[
		
		'doc_usuario',
		'clave_usuario',
		'mail_usuario',
		'tipo_usuario'
    ];

    protected $guarded=[

    ];
}
