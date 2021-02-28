<?php

namespace sockedOp\Http\Requests;

use sockedOp\Http\Requests\Request;

class FichaFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_documento'=>'required|max:20',
            'tipo_documento'=>'required|max:20',
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'direccion'=>'required|max:50',
            'barrio'=>'required|max:50',
            'celular'=>'required|max:15',
            'email'=>'required|max:50',
            'nombre_acudiente'=>'required|max:50',
            'apellidos_acudiente'=>'required|max:50',
            'tel_acudiente'=>'required|max:15',
            'email_acudiente'=>'required|max:50',
            'parentesco_acu'=>'required|max:50',
            'funcionario'=>'required',
            'categoria'=>'required',
            'foto'=>'mimes:jpeg,bmp,png',			
			'fecha_nacimiento'=>'date',
			'rh'=>'required',
			'eps'=>'required',
			'estatura'=>'required',
			'peso'=>'required',
			'talla'=>'required',
			'n_calzada'=>'required',
			'posicion'=>'required',
			'club_otro'=>'max:200'
			
        ];
    }
}
