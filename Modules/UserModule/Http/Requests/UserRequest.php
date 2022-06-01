<?php

namespace Modules\UserModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->supervisor_id==0){
            return [
                'name'=>'required|string',
                'addressName'=>'required|string',
                'government'=>'required|numeric',
                'region'=>'required|numeric',
                'widget'=>'required|string',
                'street'=>'required|string',
                'avenue'=>'required|string',
                'home_number'=>'nullable|numeric',
                'floor'=>'required|numeric',
                'flat'=>'required|numeric',
                'mobile'=>'required|numeric|digits:8|starts_with:5,6,9',
                'phone'=>'required|numeric|digits:8|starts_with:5,6,9',
                'civil_id'=>'required|string|digits:12'
            ];
        }

        return [
        'name'=>'required|string',
        'mobile'=>'required|numeric|digits:8|starts_with:5,6,9',
        'phone'=>'required|numeric|digits:8|starts_with:5,6,9',
        'civil_id'=>'required|string|digits:12',
//        'image'=>'nullable|sometimes|image|mimes:jpg,png,jpeg,webp'
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
