<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AdminsRequest extends FormRequest
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
            'name'=>'required|min:3|max:25',
            'email',
            'password'=>'required|min:3|max:25',
            'city_id'=>'required',
            'state_id'=>'required',
            'email'=>'required|email|max:255|unique:users',


        ];
    }
}
