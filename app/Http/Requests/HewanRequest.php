<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HewanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_hewan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'jenis_hewan' => 'required|in:Kucing,Anjing',
            'ras_hewan' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nama_hewan.required' => 'Nama hewan harus diisi.',
            'nama_hewan.string' => 'Nama hewan harus berupa teks.',
            'nama_hewan.max' => 'Nama hewan tidak boleh lebih dari 255 karakter.',

            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus salah satu dari: Jantan, Betina.',

            'jenis_hewan.required' => 'Jenis hewan harus dipilih.',
            'jenis_hewan.in' => 'Jenis hewan harus salah satu dari: Kucing, Anjing.',

            'ras_hewan.required' => 'Ras hewan harus diisi.',
            'ras_hewan.string' => 'Ras hewan harus berupa teks.',
            'ras_hewan.max' => 'Ras hewan tidak boleh lebih dari 255 karakter.',
        ];
    }
}
