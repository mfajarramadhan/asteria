<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobOrder;
use App\Models\JobOrderTool;

class JobOrderSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Job Order 1
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

        // Buat Tools ke-1 JO 1  
        JobOrderTool::create([
            'job_order_id' => $jobOrder->id,
            'tool_id' => 1, // Bejana Tekan Air (PUBT)
            'qty' => 1,
            'status' => 'Pertama',
            'kapasitas' => '500L',
            'model' => 'BT-001',
            'no_seri' => 'PUBT001',
        ]);

        // Buat Tools ke-2 JO 1  
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

        // Buat Penanggung Jawab 1
        $jobOrder->responsibles()->attach([3, 5]);


        // // Buat Job Order 2
        // $jobOrder2 = JobOrder::create([
        //     'nama_perusahaan' => 'PT Sejahtera Abadi',
        //     'alamat_perusahaan' => 'Jl. Melati No. 123',
        //     'pic_order' => 'Budi',
        //     'email' => 'budi@gmail.com',
        //     'contact_person' => '081234567890',
        //     'no_penawaran' => '298/3-PH/IX/2024/03-rev',
        //     'no_purcash_order' => '0002',
        //     'tanggal_pemeriksaan1' => '2025-10-01',
        //     'tanggal_pemeriksaan2' => '2025-10-02',
        //     'tanggal_pemeriksaan3' => null,
        //     'tanggal_pemeriksaan4' => null,
        //     'tanggal_pemeriksaan5' => null,
        //     'jumlah_hari_pemeriksaan' => 2,
        //     'tanggal_dibuat' => '2025-09-25',
        //     'tanggal_selesai' => '2025-10-02',
        //     'jam_bertemu' => '08:00',
        //     'jam_selesai' => '14:00',
        //     'pic_ditemui' => 'Sutrisno',
        //     'contact_person2' => '081298765432',
        //     'nomor_jo' => 'JO-423',
        //     'kelengkapan_manual_book' => 1,
        //     'qty_manual_book' => 1,
        //     'kelengkapan_layout' => 1,
        //     'qty_layout' => 1,
        //     'kelengkapan_maintenance_report' => 1,
        //     'qty_maintenance_report' => 1,
        //     'kelengkapan_surat_permohonan' => 0,
        //     'qty_surat_permohonan' => null,
        //     'catatan' => 'Job Order Kedua',
        // ]);

        // // Buat Tools ke-1 JO 2  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder2->id,
        //     'tool_id' => 5, 
        //     'qty' => 2,
        //     'status' => 'Pertama',
        //     'kapasitas' => '200L',
        //     'model' => 'FK-001',
        //     'no_seri' => 'PAPA001',
        // ]);

        // // Buat Tools ke-2 JO 2  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder2->id,
        //     'tool_id' => 5, 
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => '300L',
        //     'model' => 'FK-002',
        //     'no_seri' => 'PAPA002',
        // ]);

        // // Buat Penanggung Jawab JO 2
        // $jobOrder2->responsibles()->attach([2, 4]);


        // // Buat Job Order 3
        // $jobOrder3 = JobOrder::create([
        //     'nama_perusahaan' => 'CV Maju Jaya',
        //     'alamat_perusahaan' => 'Jl. Kenanga No. 45',
        //     'pic_order' => 'Sari',
        //     'email' => 'sari@gmail.com',
        //     'contact_person' => '087812345678',
        //     'no_penawaran' => '299/3-PH/X/2024/04-rev',
        //     'no_purcash_order' => '0003',
        //     'tanggal_pemeriksaan1' => '2025-10-05',
        //     'tanggal_pemeriksaan2' => '2025-10-06',
        //     'jumlah_hari_pemeriksaan' => 2,
        //     'tanggal_dibuat' => '2025-09-28',
        //     'tanggal_selesai' => '2025-10-06',
        //     'jam_bertemu' => '10:00',
        //     'jam_selesai' => '16:00',
        //     'pic_ditemui' => 'Rian',
        //     'contact_person2' => '087876543210',
        //     'nomor_jo' => 'JO-424',
        //     'kelengkapan_manual_book' => 0,
        //     'kelengkapan_layout' => 1,
        //     'qty_layout' => 2,
        //     'kelengkapan_maintenance_report' => 1,
        //     'qty_maintenance_report' => 2,
        //     'kelengkapan_surat_permohonan' => 1,
        //     'qty_surat_permohonan' => 1,
        //     'catatan' => 'Job Order Ketiga',
        // ]);

        // // Buat Tools ke-1 JO 3  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder3->id,
        //     'tool_id' => 9,
        //     'qty' => 3,
        //     'status' => 'Pertama',
        //     'kapasitas' => '400L',
        //     'model' => 'EM-001',
        //     'no_seri' => 'ESK001',
        // ]);

        // // Buat Tools ke-2 JO 3  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder3->id,
        //     'tool_id' => 9,
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => '150L',
        //     'model' => 'EM-002',
        //     'no_seri' => 'ESK001',
        // ]);

        // // Buat Penanggung Jawab JO 3
        // $jobOrder3->responsibles()->attach([1, 3]);
    }
}
