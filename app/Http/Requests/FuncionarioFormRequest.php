<?php

namespace sockedOp\Http\Requests;

use sockedOp\Http\Requests\Request;

class FuncionarioFormRequest extends Request
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
        
	   	'tipo_documento'=>'required|max:20',
	    'nombres'=>'required|max:50',
	   	'apellidos'=>'required|max:50',
	   	'celular'=>'required|max:20',
	   	'direccion'=>'required|max:50'
	   	
        ];
    }
}
