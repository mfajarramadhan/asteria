<?php

namespace Database\Seeders;

use App\Models\SubJenisRiksaUji;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubJenisRiksaUjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // PUBT
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 1,
            'sub_jenis' => 'Bejana Tekan',
        ]);

        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 1,
            'sub_jenis' => 'Katel Uap',
        ]);

        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 1,
            'sub_jenis' => 'Screw Compressor',
        ]);

        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 1,
            'sub_jenis' => 'Tangki Timbun',
        ]);

        // PTP
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 2,
            'sub_jenis' => 'Pesawat Tenaga Produksi',
        ]);

        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 2,
            'sub_jenis' => 'Motor Diesel',
        ]);
        
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 2,
            'sub_jenis' => 'Heat Treatment',
        ]);

        // PAPA
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 3,
            'sub_jenis' => 'Scissor Lift',
        ]);

        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 3,
            'sub_jenis' => 'Wheel Loader',
        ]);
        
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 3,
            'sub_jenis' => 'Dump Trailer',
        ]);
        
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 3,
            'sub_jenis' => 'Crane',
        ]);
        
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 3,
            'sub_jenis' => 'Forklift',
        ]);
        
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 3,
            'sub_jenis' => 'Cargo Lift',
        ]);

        // LISTRIK
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 4,
            'sub_jenis' => 'Instalasi Listrik',
        ]);

        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 4,
            'sub_jenis' => 'Instalasi Penyalur Petir',
        ]);

        // ESK
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 5,
            'sub_jenis' => 'Eskalator',
        ]);

        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 5,
            'sub_jenis' => 'Elevator',
        ]);

        // IPK
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 6,
            'sub_jenis' => 'Instalasi Fire Hydrant',
        ]);

        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 6,
            'sub_jenis' => 'Instalasi Fire Alarm',
        ]);

        // LINGKER
        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 7,
            'sub_jenis' => 'Penerangan',
        ]);

        SubJenisRiksaUji::create([
            'jenis_riksa_uji_id' => 7,
            'sub_jenis' => 'Kebisingan',
        ]);
    }
}
