<?php

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PUBT
        Tool::create([
            'nama' => 'Bejana Tekan Air',
            'jenis_riksa_uji_id' => 1,
            'sub_jenis_riksa_uji_id' => 1, // Bejana Tekan
        ]);
        Tool::create([
            'nama' => 'Katel Uap Industri',
            'jenis_riksa_uji_id' => 1,
            'sub_jenis_riksa_uji_id' => 2, // Katel Uap
        ]);

        // PTP
        Tool::create([
            'nama' => 'Motor Diesel Generator',
            'jenis_riksa_uji_id' => 2,
            'sub_jenis_riksa_uji_id' => 6, // Motor Diesel
        ]);
        Tool::create([
            'nama' => 'Oven Heat Treatment',
            'jenis_riksa_uji_id' => 2,
            'sub_jenis_riksa_uji_id' => 7, // Heat Treatment/Oven
        ]);

        // PAPA
        Tool::create([
            'nama' => 'Forklift Gudang',
            'jenis_riksa_uji_id' => 3,
            'sub_jenis_riksa_uji_id' => 12, // Forklift
        ]);
        Tool::create([
            'nama' => 'Crane Overhead',
            'jenis_riksa_uji_id' => 3,
            'sub_jenis_riksa_uji_id' => 10, // Crane
        ]);

        // LISTRIK
        Tool::create([
            'nama' => 'Panel Instalasi Listrik',
            'jenis_riksa_uji_id' => 4,
            'sub_jenis_riksa_uji_id' => 14, // Instalasi Listrik
        ]);
        Tool::create([
            'nama' => 'Instalasi Penyalur Petir',
            'jenis_riksa_uji_id' => 4,
            'sub_jenis_riksa_uji_id' => 15, // Instalasi Penyalur Petir
        ]);

        // ESK
        Tool::create([
            'nama' => 'Escalator Mall',
            'jenis_riksa_uji_id' => 5,
            'sub_jenis_riksa_uji_id' => 16, // Escalator
        ]);
        Tool::create([
            'nama' => 'Elevator Penumpang',
            'jenis_riksa_uji_id' => 5,
            'sub_jenis_riksa_uji_id' => 17, // Elevator
        ]);

        // IPK
        Tool::create([
            'nama' => 'Instalasi Fire Hydrant',
            'jenis_riksa_uji_id' => 6,
            'sub_jenis_riksa_uji_id' => 18, // Fire Hydrant
        ]);
        Tool::create([
            'nama' => 'Instalasi Fire Alarm',
            'jenis_riksa_uji_id' => 6,
            'sub_jenis_riksa_uji_id' => 19, // Fire Alarm
        ]);

        // LINGKER
        Tool::create([
            'nama' => 'Penerangan Pabrik',
            'jenis_riksa_uji_id' => 7,
            'sub_jenis_riksa_uji_id' => 20, // Penerangan
        ]);
        Tool::create([
            'nama' => 'Pengukuran Kebisingan',
            'jenis_riksa_uji_id' => 7,
            'sub_jenis_riksa_uji_id' => 21, // Kebisingan
        ]);
    }
}
