<?php

namespace App\Http\Requests\Admin\ControlPoint;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required',
            'lake_id' => 'required',
            'number' => 'nullable',
            'name_ky' => 'nullable',
            'description' => 'nullable',
            'description_ky' => 'nullable',
            'X_coordinate' => 'nullable',
            'Y_coordinate' => 'nullable',
        ];
    }
}
