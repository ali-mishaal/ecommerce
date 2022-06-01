<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateQOrderRequest extends FormRequest
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
            'client_name' => ['required'],
//            'supervisor_id' => ['required'],
            'driver_id' => ['nullable'],

//            'address' => ['required', 'string', 'min:3', 'max:200'],
            'mobile' => ['required', 'min:3', 'max:200'],
            'amount' => ['required', 'numeric', 'min:1'],
            'order_fees' => ['nullable'],
            'delivery_time' => ['required'],
            'customer_mobile' => ['required', 'min:3', 'max:200'],
            'customer_name' => ['required', 'string', 'min:3', 'max:200'],
            'address_name' => 'required|string',
            'government' => ['required', 'integer', Rule::exists('governments', 'id')],
            'region' => ['required', 'integer', Rule::exists('regions', 'id')],
            'widget' => 'required|string',
            'street' => 'required|string',
            'avenue' => 'required|string',
            'home_number' => 'required|numeric',
            'floor' => 'required|numeric',
            'flat' => 'required|numeric',
            'cgovernment' => ['required', 'integer', Rule::exists('governments', 'id')],
            'cregion' => ['required', 'integer', Rule::exists('regions', 'id')],
            'cwidget' => 'nullable|string',
            'cstreet' => 'nullable|string',
            'cavenue' => 'nullable|string',
            'chome_number' => 'nullable|numeric',
            'cfloor' => 'nullable|numeric',
            'cflat' => 'nullable|numeric',
        ];
    }
}
