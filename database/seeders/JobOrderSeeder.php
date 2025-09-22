<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobOrder;
use App\Models\JobOrderTool;

class JobOrderSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Job Order
        $jobOrder = JobOrder::create([
            'nama_perusahaan' => 'Asteria',
            'alamat_perusahaan' => 'Perum Asteria Galuh Mas',
            'pic_order' => 'Aziz',
            'email' => 'aziz@gmail.com',
            'contact_person' => '0895333530959',
            'no_penawaran' => '297/3-PH/VIII/2024/02-rev',
            'no_purcash_order' => '0001',
            'tanggal_pemeriksaan1' => '2025-09-20',
            'tanggal_pemeriksaan2' => '2025-09-21',
            'tanggal_pemeriksaan3' => null,
            'tanggal_pemeriksaan4' => null,
            'tanggal_pemeriksaan5' => null,
            'jumlah_hari_pemeriksaan' => 2,
            'tanggal_dibuat' => '2025-09-20',
            'tanggal_selesai' => '2025-09-21',
            'jam_bertemu' => '09:00',
            'jam_selesai' => '15:00',
            'pic_ditemui' => 'Aziz',
            'contact_person2' => '0895333530959',
            'nomor_jo' => 'JO-422',
            'kelengkapan_manual_book' => 1,
            'qty_manual_book' => 2,
            'kelengkapan_layout' => 0,
            'qty_layout' => null,
            'kelengkapan_maintenance_report' => 0,
            'qty_maintenance_report' => null,
            'kelengkapan_surat_permohonan' => 1,
            'qty_surat_permohonan' => 4,
            'catatan' => 'Job Order Pertama',
        ]);

        // Buat Tools nya 
        JobOrderTool::create([
            'job_order_id' => $jobOrder->id,
            'tool_id' => 1, // Bejana Tekan Air (PUBT)
            'qty' => 1,
            'status' => 'Pertama',
            'kapasitas' => '500L',
            'model' => 'BT-001',
            'no_seri' => 'PUBT001',
        ]);

        JobOrderTool::create([
            'job_order_id' => $jobOrder->id,
            'tool_id' => 1, // Bejana Tekan Air (PUBT)
            'qty' => 1,
            'status' => 'Resertifikasi',
            'kapasitas' => '100L',
            'model' => 'BT-002',
            'no_seri' => 'PUBT002',
            'status_tool' => 'selesai',
            'finished_at' => today(),
        ]);

        // Buat Penanggung Jawab
        $jobOrder->responsibles()->attach([3, 5]);
    }
}
