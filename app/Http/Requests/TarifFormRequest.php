<?php

namespace gestiune_cimitire\Http\Requests;

use gestiune_cimitire\Http\Requests\Request;

class TarifFormRequest extends Request
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
        'an'=>'required|integer|min:1900|max:2100|unique:tarife,an,' . $this->id . ',id',
        'redeventa'=>'required|numeric|min:0' ,
        'intretinere'=>'required|numeric|min:0' 
        ];
    }
}
