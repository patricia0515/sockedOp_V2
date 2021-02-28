<?php

namespace sockedOp;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';

    protected $primaryKey='idcategoria';
	
	//Laravel puede automaticamente asignar a la tabla dos columnas, estas permitiran especificar cuando an sido creados u actualizados los registros: para este caso lo dejamos en false, ya que no lo necesitamos en esta ocación.
    public $timestamps=false;

    protected $fillable=[
    	'nombre',
    	'descripcion',
    	'condicion'
    ];

    protected $guarded=[

    ];
}
