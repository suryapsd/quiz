<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoalTesAwalRequest extends FormRequest
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
            'soal' => 'required|string',
            'jawaban_a' => 'required|string',
            'jawaban_b' => 'required|string',
            'jawaban_c' => 'required|string',
            'jawaban_d' => 'required|string',
            'kunci_jawaban' => 'required|in:A,B,C,D', // Adjust the allowed values as needed
        ];
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'soal.required' => 'Kolom soal wajib diisi.',
            'soal.string' => 'Kolom soal harus berupa teks.',
    
            'jawaban_a.required' => 'Kolom jawaban A wajib diisi.',
            'jawaban_a.string' => 'Kolom jawaban A harus berupa teks.',
    
            'jawaban_b.required' => 'Kolom jawaban B wajib diisi.',
            'jawaban_b.string' => 'Kolom jawaban B harus berupa teks.',
    
            'jawaban_c.required' => 'Kolom jawaban C wajib diisi.',
            'jawaban_c.string' => 'Kolom jawaban C harus berupa teks.',
    
            'jawaban_d.required' => 'Kolom jawaban D wajib diisi.',
            'jawaban_d.string' => 'Kolom jawaban D harus berupa teks.',
    
            'kunci_jawaban.required' => 'Kolom kunci jawaban wajib diisi.',
            'kunci_jawaban.in' => 'Kolom kunci jawaban harus berisi A, B, C, atau D.', // Adjust the allowed values as needed
        ];
    }
}
