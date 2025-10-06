<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormKpEskalatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // pastikan boleh disubmit
    }

    public function rules(): array
    {
        return [
            'job_order_tool_id' => ['required', 'exists:job_order_tools,id'],

            // Informasi umum
            'tanggal_pemeriksaan' => ['nullable', 'date'],
            'nama_perusahaan' => ['nullable', 'string'],
            'jenis_eskalator' => ['nullable', 'string'],
            'merk_eskalator' => ['nullable', 'string'],
            'nomor_seri' => ['nullable', 'string'],
            'kapasitas' => ['nullable', 'string'],
            'melayani' => ['nullable', 'string'],
            'lokasi_eskalator' => ['nullable', 'string'],

            // Foto (array file)
            'pagar_pelindung' => ['nullable', 'array'],
            'pagar_pelindung.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],

            'ban_pegangan_foto' => ['nullable', 'array'],
            'ban_pegangan_foto.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],

            'peralatan_pengaman_foto' => ['nullable', 'array'],
            'peralatan_pengaman_foto.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],

            // Pemeriksaan Dimensi dan Keamanan (angka pakai step 0.0001)
            'tinggi' => ['nullable', 'numeric'],
            'tekanan_samping' => ['nullable', 'numeric'],
            'tekanan_vertikal' => ['nullable', 'numeric'],

            // Ban Pegangan
            'kecepatan_ban_pegangan' => ['nullable', 'numeric'],
            'lebar_ban_pegangan' => ['nullable', 'numeric'],

            // Lain-lain (radio + keterangan)
            '*.keterangan' => ['nullable', 'string'],
        ];
    }
}
