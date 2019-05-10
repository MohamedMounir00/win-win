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
         $data=[];
        $data['title']='required';
        $data['desc']='required';
        //$data['photos']='required';
        foreach ($type->questions as $value)
        {
            switch ($value->key) {
                case 'rooms':
                    $data[$value->key]='required|min:0|max:9';
                    break;
                case 'price':
                    $data[$value->key]='required|min:0|max:9';
                    break;
                case 'floor':
                    $data[$value->key]='required|min:0|max:9';
                    break;
                case 'bathroom':
                    $data[$value->key]='required|min:0|max:9';
                    break;
                default:
                    $data[$value->key]='required';
                    break;
            }

        }
          return $data;
    }
}
