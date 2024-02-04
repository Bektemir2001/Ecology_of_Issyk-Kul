<?php

namespace App\Http\Requests\Operator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class StorePointRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable',
            'name_ky' => 'nullable',
            'distance_from_starting_point' => 'required',
            'control_point_id' => 'required',
            'depth' => 'required',
            'date' => 'required',
            'depth_item' => 'required',
            'temperature' => 'required',
            'transparency' => 'required',
            'hardness' => 'required',
            'electrical_conductivity' => 'required',
            'pH' => 'required',
            'oxygen_mg' => 'required',
            'oxygen_saturation' => 'required',
            'X_coordinate' => 'nullable',
            'Y_coordinate' => 'nullable',
            'elements' => 'required',
            'major_ions' => 'required',
            'organic_substances' => 'required'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ])->setStatusCode(403));
    }
}
