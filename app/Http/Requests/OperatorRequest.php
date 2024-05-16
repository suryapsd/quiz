<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperatorRequest extends FormRequest
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
        $userId = $this->route('operator.create') ? $this->route('operator.create')->id_user : null;

        return [
            'username' => 'required|unique:users,username,' . $userId,
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => 'required|min:8',
            'nama' => 'required',
            'no_telepon' => 'nullable|numeric',
            'alamat' => 'nullable',
        ];
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'no_telepon.numeric' => 'Nomor telepon harus berupa angka.',
        ];
    }
}
