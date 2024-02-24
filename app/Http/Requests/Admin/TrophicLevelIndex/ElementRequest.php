<?php

namespace App\Http\Requests\Admin\TrophicLevelIndex;

use Illuminate\Foundation\Http\FormRequest;

class ElementRequest extends FormRequest
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
            't_index_id' => 'required',
            'element_id' => 'required',
            'from' => 'required',
            'to' => 'required'
        ];
    }
}
