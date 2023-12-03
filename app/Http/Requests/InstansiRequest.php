<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstansiRequest extends FormRequest
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
            'nama_instansi' => 'required|string|max:255',
            'min_tinggi_badan' => 'required|numeric|min:0',
        ];
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'nama_instansi.required' => 'Kolom nama instansi wajib diisi.',
            'nama_instansi.string' => 'Kolom nama instansi harus berupa teks.',
            'nama_instansi.max' => 'Kolom nama instansi tidak boleh lebih dari :max karakter.',

            'min_tinggi_badan.required' => 'Kolom minimum tinggi badan wajib diisi.',
            'min_tinggi_badan.numeric' => 'Kolom minimum tinggi badan harus berupa angka.',
            'min_tinggi_badan.min' => 'Kolom minimum tinggi badan tidak boleh kurang dari :min.',
        ];
    }
}
