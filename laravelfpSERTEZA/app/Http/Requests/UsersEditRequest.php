<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersEditRequest extends FormRequest
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
        //En este Request no incluimos como obligatorio el password
         return [
            //
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
            'is_active'=>'required'
        ];
    }
}
