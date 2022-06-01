<?php

namespace Modules\CommonModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiclesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand'=>'required|numeric',
            'color'=>'required|string',
            'vehicle_number'=>'required|numeric',
            'system_number'=>'required|numeric',
            'type'=>'required|numeric',

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
