<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisSoalRequest extends FormRequest
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
            'nama_jenis_soal' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ];
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'nama_jenis_soal.required' => 'Kolom nama jenis soal wajib diisi.',
            'nama_jenis_soal.string' => 'Kolom nama jenis soal harus berupa teks.',
            'nama_jenis_soal.max' => 'Kolom nama jenis soal tidak boleh lebih dari :max karakter.',
    
            'keterangan.required' => 'Kolom keterangan wajib diisi.',
            'keterangan.string' => 'Kolom keterangan harus berupa teks.',
        ];
    }
}
