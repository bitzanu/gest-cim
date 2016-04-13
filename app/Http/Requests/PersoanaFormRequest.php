<?php

namespace gestiune_cimitire\Http\Requests;

use gestiune_cimitire\Http\Requests\Request;

class PersoanaFormRequest extends Request
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
        'nume'=> 'required' ,
        'prenume' => 'required' ,
        'CNP' => 'digits:13|unique:persoane,CNP,' . $this->id . ',id',
        'adresa'=>'required'
        ];
    }
}
