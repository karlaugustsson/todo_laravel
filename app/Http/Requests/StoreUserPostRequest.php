<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Validator;
use Illuminate\Http\Response;
class StoreUserPostRequest extends Request
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
     
        $rules = [
            'name' => "required|min:3|max:40",
            'email' => "required|unique:users|Email|max:160",
            'password' => "required"
            ];

        if(Request::isMethod('patch')) {

        $rules = [
            'name' => "required|min:3|max:40",
            'email' => "unique:users|Email|max:160"
            ];
            
        }

    return $rules;
}

}
