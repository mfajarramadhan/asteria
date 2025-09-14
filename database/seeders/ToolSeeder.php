<?php

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tool::create([
            'nama' => 'Forklift',
            'jenis'   => 'PUBT',
            // 'lampiran'    => null,
            // 'deskripsi'     => 'Alat riksa uji dengan status Resertifikasi',
        ]);

        Tool::create([
            'nama' => 'Hydrant',
            'jenis'   => 'IPK',
            // 'lampiran'    => null,
            // 'deskripsi'     => 'Alat riksa uji dengan status Resertifikasi',
        ]);

        Tool::create([
            'nama' => 'Boiler',
            'jenis'   => 'PUBT',
            // 'lampiran'    => null,
            // 'deskripsi'     => 'Alat riksa uji dengan status Resertifikasi',
        ]);

        Tool::create([
            'nama' => 'Turbin',
            'jenis'   => 'PTP',
            // 'lampiran'    => null,
            // 'deskripsi'     => 'Alat riksa uji dengan status Resertifikasi',
        ]);
    }
}
