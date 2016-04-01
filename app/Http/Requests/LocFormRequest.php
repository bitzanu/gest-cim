<?php

namespace gestiune_cimitire\Http\Requests;

use gestiune_cimitire\Http\Requests\Request;

class LocFormRequest extends Request
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
            'numar'=> 'required | unique:locuri,numar,' . $this->loc . ',id,parcela_id,' . $this->parcela,
            'lungime'=>'numeric|required',
            'latime'=>'numeric|required',
            'numar_locuri'=>'numeric|required',
            'cimitir'=>'exists:cimitire,id,deleted_at,NULL',
            'parcela'=>'exists:parcele,id,deleted_at,NULL'
        ];
    }
}
