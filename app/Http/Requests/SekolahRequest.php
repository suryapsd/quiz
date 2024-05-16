<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SekolahRequest extends FormRequest
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
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'keterangan' => 'nullable|string',
        ];
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'nama_sekolah.required' => 'Kolom nama sekolah wajib diisi.',
            'nama_sekolah.string' => 'Kolom nama sekolah harus berupa teks.',
            'nama_sekolah.max' => 'Kolom nama sekolah tidak boleh lebih dari :max karakter.',
    
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'alamat.string' => 'Kolom alamat harus berupa teks.',

            'keterangan.required' => 'Kolom keterangan wajib diisi.',
            'keterangan.string' => 'Kolom keterangan harus berupa teks.',
        ];
    }
}
