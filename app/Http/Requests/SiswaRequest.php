<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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
            'id_sekolah' => 'required|numeric|min:0',
            'nama' => 'required|string|max:255',
            'no_wa' => 'required|numeric',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan', // Adjust the allowed values as needed
            'tinggi_badan' => 'required|numeric|min:0',
        ];
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'id_sekolah.required' => 'Kolom ID sekolah wajib diisi.',
            'id_sekolah.numeric' => 'Kolom ID sekolah harus berupa angka.',
            'id_sekolah.min' => 'Kolom ID sekolah tidak boleh kurang dari :min.',
    
            'nama.required' => 'Kolom nama wajib diisi.',
            'nama.string' => 'Kolom nama harus berupa teks.',
            'nama.max' => 'Kolom nama tidak boleh lebih dari :max karakter.',
    
            'no_wa.required' => 'Kolom nomor WhatsApp wajib diisi.',
            'no_wa.numeric' => 'Kolom nomor WhatsApp harus berupa angka.',
    
            'jenis_kelamin.required' => 'Kolom jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Kolom jenis kelamin harus berisi Laki-laki atau Perempuan.',
    
            'tinggi_badan.required' => 'Kolom tinggi badan wajib diisi.',
            'tinggi_badan.numeric' => 'Kolom tinggi badan harus berupa angka.',
            'tinggi_badan.min' => 'Kolom tinggi badan tidak boleh kurang dari :min.',
        ];
    }
}
