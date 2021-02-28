<?php

namespace sockedOp;

use Illuminate\Database\Eloquent\Model;

class Ficha_tecnica extends Model
{
    protected $table='ficha_tecnica';

    protected $primaryKey='id_ficha_tecnica';
	
	//Laravel puede automaticamente asignar a la tabla dos columnas, estas permitiran especificar cuando an sido creados u actualizados los registros: para este caso lo dejamos en false, ya que no lo necesitamos en esta ocación.
    public $timestamps=false;

    protected $fillable=[
		
    	'id_ficha_tecnica',
    	'fecha_nacimiento',
    	'rh',
    	'edad',
    	'eps',
    	'estatura',
    	'peso',
    	'talla',
    	'n_calzada',
    	'posicion',
    	'club_otro',
        'estudiante'
    ];

    protected $guarded=[

    ];
}
