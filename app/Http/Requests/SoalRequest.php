<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoalRequest extends FormRequest
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
            'nama_jenis_soal' => 'required|string',
            'id_pendidikan_instansi' => 'required|string',
            'inputs.*.soal' => 'required|string',
            'inputs.*.jawaban_a' => 'required|string',
            'inputs.*.jawaban_b' => 'required|string',
            'inputs.*.jawaban_c' => 'required|string',
            'inputs.*.jawaban_d' => 'required|string',
            'inputs.*.kunci_jawaban' => 'required|in:A,B,C,D',
        ];
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'nama_jenis_soal.required' => 'Nama jenis soal harus diisi.',
            'id_pendidikan_instansi.required' => 'Pendidikan instansi harus diisi.',
            'inputs.*.soal.required' => 'Pertanyaan pada setiap soal harus diisi.',
            'inputs.*.jawaban_a.required' => 'Jawaban A pada setiap soal harus diisi.',
            'inputs.*.jawaban_b.required' => 'Jawaban B pada setiap soal harus diisi.',
            'inputs.*.jawaban_c.required' => 'Jawaban C pada setiap soal harus diisi.',
            'inputs.*.jawaban_d.required' => 'Jawaban D pada setiap soal harus diisi.',
            'inputs.*.kunci_jawaban.required' => 'Kunci jawaban pada setiap soal harus diisi.',
            'inputs.*.kunci_jawaban.in' => 'Kunci jawaban pada setiap soal harus salah satu dari: A, B, C, D.',
        ];
    }
}
