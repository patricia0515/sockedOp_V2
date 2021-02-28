<?php

namespace sockedOp\Http\Requests;

use sockedOp\Http\Requests\Request;

class CategoriaFormRequest extends Request
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
            'nombre'=>'required|max:45',
            'descripcion'=>'max:100'
            //aqui se pone el nombre del objeto en el formulario Html no del campo en la base de datos
        ];
    }
}
