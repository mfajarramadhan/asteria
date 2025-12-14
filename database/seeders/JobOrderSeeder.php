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

        // Buat Tool ke-1 PUBT
        JobOrderTool::create([
            'job_order_id' => $jobOrder->id,
            'tool_id' => 1, // Bejana Tekan Air
            'qty' => 1,
            'status' => 'Pertama',
            'kapasitas' => '500L',
            'model' => 'BT-001',
            'no_seri' => 'PUBT001',
        ]);

        // // Buat Tool ke-2 PUBT
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 2, // Katel Uap Industri
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => '100L',
        //     'model' => 'KU-001',
        //     'no_seri' => 'PUBT002',
        // ]);

        // // Buat Tool ke-3 PUBT
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 3, // Ingersoll Screw Compressor
        //     'qty' => 1,
        //     'status' => 'Pertama',
        //     'kapasitas' => '45 kW, 10 bar',
        //     'model' => 'SC-001',
        //     'no_seri' => 'PUBT003',
        // ]);

        // // Buat Tool ke-4 PUBT
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 4, // Tangki Timbun Solar
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => '50.000 Liter',
        //     'model' => 'TT-001',
        //     'no_seri' => 'PUBT004',
        // ]);



        // Buat Tools ke-1 PTP  
        JobOrderTool::create([
            'job_order_id' => $jobOrder->id,
            'tool_id' => 5, // Generator Set
            'qty' => 1,
            'status' => 'Pertama',
            'kapasitas' => '500 kVA',
            'model' => 'GS-001',
            'no_seri' => 'PTP001',
        ]);

        // // Buat Tools ke-2 PTP  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 6, // Motor Diesel Generator
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => '500 kVA',
        //     'model' => 'MD-001',
        //     'no_seri' => 'PTP002',
        // ]);

        // // Buat Tools ke-3 PTP  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 7, // Oven Heat Treatment
        //     'qty' => 1,
        //     'status' => 'Pertama',
        //     'kapasitas' => '1000 °C',
        //     'model' => 'OT-001',
        //     'no_seri' => 'PTP003',
        // ]);



        // Buat Tools ke-1 PAPA  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 8, // Genie Scissor Lift
        //     'qty' => 1,
        //     'status' => 'Pertama',
        //     'kapasitas' => '350 Kg',
        //     'model' => 'SL-001',
        //     'no_seri' => 'PAPA001',
        // ]);

        // // Buat Tools ke-2 PAPA  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 9, // Komatsu Wheel Loader
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => '2.7 m³',
        //     'model' => 'WL-001',
        //     'no_seri' => 'PAPA002',
        // ]);

        // // Buat Tools ke-3 PAPA  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 10, // Truk Dump Trailer
        //     'qty' => 1,
        //     'status' => 'Pertama',
        //     'kapasitas' => '40 Ton',
        //     'model' => 'DL-001',
        //     'no_seri' => 'PAPA003',
        // ]);

        // // Buat Tools ke-4 PAPA  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 11, // Crawler Crane
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => '250 Ton',
        //     'model' => 'CC-001',
        //     'no_seri' => 'PAPA004',
        // ]);

        // // Buat Tools ke-5 PAPA  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 12, // Toyota Forklift
        //     'qty' => 1,
        //     'status' => 'Pertama',
        //     'kapasitas' => '3 Ton',
        //     'model' => 'FK-001',
        //     'no_seri' => 'PAPA005',
        // ]);

        // // Buat Tools ke-6 PAPA  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 13, // Cargo Lift Hydraulic
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => '5000 Kg',
        //     'model' => 'CL-001',
        //     'no_seri' => 'PAPA006',
        // ]);



        // // Buat Tools ke-1 Listrik  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 14, // Genset Diesel
        //     'qty' => 1,
        //     'status' => 'Pertama',
        //     'kapasitas' => '100 kVA',
        //     'model' => 'IL-001',
        //     'no_seri' => 'LTK001',
        // ]);

        // // Buat Tools ke-2 Listrik  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 15, // Penangkal Petir Elektrostatis
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => 'Radius proteksi 79 m',
        //     'model' => 'PP-001',
        //     'no_seri' => 'LTK002',
        // ]);



        // Buat Tools ke-1 ESK  
        JobOrderTool::create([
            'job_order_id' => $jobOrder->id,
            'tool_id' => 16, // Escalator Mall
            'qty' => 1,
            'status' => 'Pertama',
            'kapasitas' => '6000 orang/jam',
            'model' => 'ESK-001',
            'no_seri' => 'ESK001',
        ]);

        // Buat Tools ke-2 ESK  
        JobOrderTool::create([
            'job_order_id' => $jobOrder->id,
            'tool_id' => 17, // Elevator Penumpang
            'qty' => 1,
            'status' => 'Resertifikasi',
            'kapasitas' => '1000 Kg / 13 orang',
            'model' => 'ELV-001',
            'no_seri' => 'ESK002',
        ]);



        // Buat Tools ke-1 IPK  
        JobOrderTool::create([
            'job_order_id' => $jobOrder->id,
            'tool_id' => 18, // Hydrant Basement
            'qty' => 1,
            'status' => 'Pertama',
            'kapasitas' => '500 GPM (1890 L/menit)',
            'model' => 'HY-001',
            'no_seri' => 'IPK001',
        ]);

        // Buat Tools ke-2 IPK  
        JobOrderTool::create([
            'job_order_id' => $jobOrder->id,
            'tool_id' => 19, // Fire Alarm Gudang
            'qty' => 1,
            'status' => 'Resertifikasi',
            'kapasitas' => '100 detector / 1 panel',
            'model' => 'FA-001',
            'no_seri' => 'IPK002',
        ]);



        // // Buat Tools ke-1 LINGKER  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 20, // Pencahayaan
        //     'qty' => 1,
        //     'status' => 'Pertama',
        //     'kapasitas' => '500 lux',
        //     'model' => 'PC-001',
        //     'no_seri' => 'LKR001',
        // ]);

        // // Buat Tools ke-2 LINGKER  
        // JobOrderTool::create([
        //     'job_order_id' => $jobOrder->id,
        //     'tool_id' => 21, // Kebisingan
        //     'qty' => 1,
        //     'status' => 'Resertifikasi',
        //     'kapasitas' => '85 dB(A)',
        //     'model' => 'KB-001',
        //     'no_seri' => 'LKR002',
        // ]);

        // Buat Penanggung Jawab 1
        $jobOrder->responsibles()->attach([2, 3, 5]);




        // Buat Job Order 2
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
    }
}
