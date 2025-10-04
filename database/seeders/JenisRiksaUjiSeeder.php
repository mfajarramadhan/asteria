<?php

namespace Database\Seeders;

use App\Models\JenisRiksaUji;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisRiksaUjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // 7 Jenis Riksa Uji
        JenisRiksaUji::create([
            'jenis' => 'PUBT',
            'nama' => 'Pesawat Uap Bejana Tekan', 
        ]);

        JenisRiksaUji::create([
            'jenis' => 'PTP',
            'nama' => 'Pesawat Tenaga Produksi', 
        ]);
        
        JenisRiksaUji::create([
            'jenis' => 'PAPA',
            'nama' => 'Pesawat Angkat Pesawat Angkut', 
        ]);
        
        JenisRiksaUji::create([
            'jenis' => 'LISTRIK',
            'nama' => 'Instalasi Listrik & Petir', 
        ]);
        
        JenisRiksaUji::create([
            'jenis' => 'ESKALATOR',
            'nama' => 'Elevator & Eskalator', 
        ]);

        JenisRiksaUji::create([
            'jenis' => 'IPK',
            'nama' => 'Instalasi Penanggulangan Kebakaran', 
        ]);

        JenisRiksaUji::create([
            'jenis' => 'LINGKER',
            'nama' => 'Lingkungan Kerja', 
        ]);
    }
}
