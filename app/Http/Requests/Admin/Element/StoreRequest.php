<?php

namespace App\Http\Requests\Admin\Element;

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
            'name' => 'required|max:255',
            'image' => 'nullable',
            'description' => 'nullable',
            'parent' => 'nullable',
            'TLI_formula' => 'nullable',
            'TSI_formula' => 'nullable'
        ];
    }
}
