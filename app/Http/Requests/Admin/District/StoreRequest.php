<?php

namespace App\Http\Requests\Admin\District;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'lake_id' => 'required',
            'name' => 'required',
            'name_ky' => 'nullable',
            'description' => 'nullable',
            'images' => 'nullable',
            'X_coordinate' => 'nullable',
            'Y_coordinate' => 'nullable'
        ];
    }
}
