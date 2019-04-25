<?php

namespace App\Http\Requests\Frontend;

use App\Type_estate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddUnitRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $type=Type_estate::find($request->type_id);
        $questions= $type->questions;
        foreach ($questions as $value)
        return [
            //
            $value->name='required'
        ];
    }
}
