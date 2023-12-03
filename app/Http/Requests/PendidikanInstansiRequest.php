<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendidikanInstansiRequest extends FormRequest
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
            'nama_pendidikan' => 'required|string|max:255',
            'min_tinggi_badan' => 'required|numeric|min:0',
            'min_nilai_tes_lanjutan' => 'required|numeric|min:0',
        ];
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'nama_pendidikan.required' => 'Kolom nama pendidikan wajib diisi.',
            'nama_pendidikan.string' => 'Kolom nama pendidikan harus berupa teks.',
            'nama_pendidikan.max' => 'Kolom nama pendidikan tidak boleh lebih dari :max karakter.',
    
            'min_tinggi_badan.required' => 'Kolom minimum tinggi badan wajib diisi.',
            'min_tinggi_badan.numeric' => 'Kolom minimum tinggi badan harus berupa angka.',
            'min_tinggi_badan.min' => 'Kolom minimum tinggi badan tidak boleh kurang dari :min.',
    
            'min_nilai_tes_lanjutan.required' => 'Kolom minimum nilai tes lanjutan wajib diisi.',
            'min_nilai_tes_lanjutan.numeric' => 'Kolom minimum nilai tes lanjutan harus berupa angka.',
            'min_nilai_tes_lanjutan.min' => 'Kolom minimum nilai tes lanjutan tidak boleh kurang dari :min.',
        ];
    }
}
