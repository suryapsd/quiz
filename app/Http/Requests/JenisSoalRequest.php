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
            'nama_jenis_soal' => 'required|string',
            'id_pendidikan_instansi' => 'required',
            'jumlah_soal' => 'required|string',
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
            'nama_jenis_soal.required' => 'Nama jenis soal harus diisi.',
            'id_pendidikan_instansi.required' => 'Pendidikan instansi harus diisi.',
            'jumlah_soal.required' => 'Jumlah soal harus diisi.',
        ];
    }
}
