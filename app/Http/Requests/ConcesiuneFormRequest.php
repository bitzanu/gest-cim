<?php

namespace gestiune_cimitire\Http\Requests;

use gestiune_cimitire\Http\Requests\Request;

class ConcesiuneFormRequest extends Request
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
            //
        'numar'=>'required',
        'tarif'=>'required',
        'durata'=>'required|integer|min:7',
        'loc'=>'required|unique:concesiuni,loc_id,' . $this->id . ',id,deleted_at,NULL,activa,1',
        'persoane'=>'required'
        ];
    }
}
