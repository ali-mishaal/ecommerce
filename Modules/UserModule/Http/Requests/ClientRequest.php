<?php

namespace Modules\UserModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->client_id==0) {
            return [
                'name' => 'required|string',
                'addressName' => 'required|string',
                'government' => 'required|numeric|exists:governments,id',
                'region' => 'required|numeric|exists:regions,id',
                'widget' => 'nullable|string',
                'street' => 'nullable|string',
                'avenue' => 'nullable|string',
                'home_number' => 'nullable|numeric',
                'floor' => 'nullable|numeric',
                'flat' => 'nullable|numeric',
                'mobile' => ['required','numeric','digits:8','starts_with:5,6,9', 'unique:users'],
                'phone' => ['required','numeric','digits:8','starts_with:5,6,9', 'unique:users'],
                'civil_id' => ['nullable', 'string', 'digits:12', 'unique:users,civil_id'],
//                'address' => 'required|string',
//                'image' => 'mimes:jpg,png,jpeg,webp',
                'activity' => 'nullable|string',
                'project_data' => 'nullable|string',
                'payment_type_id' => 'nullable|numeric',
                'limit' => 'nullable|numeric|min:0',
                'payment_method_id' => 'nullable|numeric',
                'fees' => 'nullable|numeric|min:0',
                'bank_account' => 'nullable|nullable|string'

            ];
        }

        return [
            'name' => 'required|string',
            'mobile'=>['required','numeric','digits:8','starts_with:5,6,9', 'unique:users,mobile,' . $this->client_id],
            'phone'=>['required','numeric','digits:8','starts_with:5,6,9', 'unique:users,phone,' .$this->client_id],
            'civil_id'=>['nullable', 'string', 'digits:12', 'unique:users,civil_id,' . $this->client_id],
            'addressName' => 'nullable|string',
//            'image' => 'mimes:jpg,png,jpeg,webp',
            'activity' => 'nullable|string',
            'project_data' => 'nullable|string',
            'payment_type_id' => 'nullable|numeric',
            'limit' => 'nullable|numeric|min:0',
            'payment_method_id' => 'nullable|numeric',
            'fees' => 'nullable|numeric|min:0',
            'bank_account' => 'nullable|nullable|string'
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
