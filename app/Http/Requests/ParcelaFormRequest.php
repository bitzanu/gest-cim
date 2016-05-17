<?php

namespace gestiune_cimitire\Http\Requests;

use gestiune_cimitire\Http\Requests\Request;

class ParcelaFormRequest extends Request
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
       'numar'=> 'required | unique:parcele,numar,' . $this->id . ',id,cimitir_id,' . $this->cimitir . ',deleted_at,NULL'
       ];
    }
}
