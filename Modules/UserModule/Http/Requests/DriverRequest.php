<?php

namespace Modules\UserModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->driver_id==0) {
            return [
                'name' => 'required|string',
                'addressName' => 'nullable|string',
                'government' => 'nullable',
                'region' => 'nullable',
                'widget' => 'nullable|string',
                'street' => 'nullable|string',
                'avenue' => 'nullable|string',
                'home_number' => 'nullable|numeric',
                'floor' => 'nullable|numeric',
                'flat' => 'nullable|numeric',
                'mobile' => ['required','numeric','digits:8','starts_with:5,6,9', 'unique:users'],
                'phone' => ['required','numeric','digits:8','starts_with:5,6,9', 'unique:users'],
                'civil_id' => ['required', 'string', 'digits:12', 'unique:users,civil_id'],
//                'image' => 'required|mimes:jpg,png,jpeg,webp',

            ];
        }

        return [
            'name' => 'required|string',
            'mobile'=>['required','numeric','digits:8','starts_with:5,6,9', 'unique:users,mobile,' . $this->driver_id],
            'phone'=>['required','numeric','digits:8','starts_with:5,6,9', 'unique:users,phone,' .$this->driver_id],
            'civil_id'=>['required', 'string', 'digits:12', 'unique:users,civil_id,' . $this->driver_id],
            'address' => 'nullable|string',

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
