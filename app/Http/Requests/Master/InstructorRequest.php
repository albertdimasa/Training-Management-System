<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama instruktor wajib diisi.',
            'name.max' => 'Nama instruktor maksimal 255 karakter.',
            'specialization.max' => 'Spesialisasi maksimal 255 karakter.',
        ];
    }
}
