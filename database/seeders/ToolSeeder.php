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
            'jenis_riksa_uji_id' => 3, 
            'sub_jenis_riksa_uji_id' => 12,
        ]);

        Tool::create([
            'nama' => 'Hydrant',
            'jenis_riksa_uji_id' => 6, 
            'sub_jenis_riksa_uji_id' => 18,
        ]);

        Tool::create([
            'nama' => 'Eskalator',
            'jenis_riksa_uji_id' => 5, 
            'sub_jenis_riksa_uji_id' => 16,
        ]);

        Tool::create([
            'nama' => 'Generator Set',
            'jenis_riksa_uji_id' => 2, 
            'sub_jenis_riksa_uji_id' => 4,
        ]);
    }
}
