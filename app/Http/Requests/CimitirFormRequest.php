<?php

namespace gestiune_cimitire\Http\Requests;

use gestiune_cimitire\Http\Requests\Request;

class CimitirFormRequest extends Request
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
        $cimitirId=$this->input('id');
        return [
            //
        'nume'=> 'required|unique:cimitire,nume,' .$cimitirId ,
        'adresa'=>'required'
        ];
    }
}
