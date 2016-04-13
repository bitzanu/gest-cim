<?php

namespace gestiune_cimitire\Http\Requests;

use gestiune_cimitire\Http\Requests\Request;

class TipFormRequest extends Request
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
        'nume'=>'required|unique:tipuri,nume,' .$this->id. '.id',
        'reducere'=>'required|numeric|min:0|max:100'
        ];
    }
}
