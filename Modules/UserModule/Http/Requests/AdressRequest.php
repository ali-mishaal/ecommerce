<?php

namespace Modules\UserModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'addressName'=>'required|string',
            'government'=>'required|numeric',
            'region'=>'required|numeric',
            'widget'=>'required|string',
            'street'=>'required|string',
            'avenue'=>'required|string',
            'home_number'=>'required|numeric',
            'floor'=>'required|numeric',
            'flat'=>'required|numeric'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
