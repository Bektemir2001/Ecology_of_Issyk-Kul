<?php

namespace App\Http\Requests\Admin\OrganicSubstance;

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
            'name' => 'required|max:255|string|unique:organic_substances',
            'name_ky' => 'nullable|max:255|string',
            'description' => 'nullable',
            'image' => 'nullable',
            'pdk_up' => 'nullable',
            'pdk_dawn' => 'nullable',
        ];
    }
}
