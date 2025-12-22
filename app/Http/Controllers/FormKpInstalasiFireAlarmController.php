<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpInstalasiFireAlarm;
use Illuminate\Support\Facades\Storage;

class FormKpInstalasiFireAlarmController extends Controller
{
    public function index()
    {
        $instalasiFireAlarms = FormKpInstalasiFireAlarm::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                    ->whereHas('tool', function ($q2) {
                        $q2->where('jenis_riksa_uji_id', 6)
                            ->where('sub_jenis_riksa_uji_id', 19);
                    });
            })
            ->get();

        return view('form_kp.ipk.instalasi_fire_alarm.index', [
            'title' => 'Hasil Kartu Pemeriksaan Instalasi Fire Alarm',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'instalasiFireAlarms' => $instalasiFireAlarms,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.ipk.instalasi_fire_alarm.create', [
            'title'         => 'Form Kartu Pemeriksaan Instalasi Fire Alarm',
            'subtitle'         => 'Isi Form KP Instalasi Fire Alarm',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'foto_informasi_umum' => 'nullable|array',
            'foto_informasi_umum.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            
            // Informasi Umum
            'nama_perusahaan' => 'nullable|string|max:150',
            'kapasitas' => 'nullable|string|max:100',
            'model_unit' => 'nullable|string|max:100',
            'nomor_seri' => 'nullable|string|max:100',
            'pabrik_pembuat' => 'nullable|string|max:100',
            'jenis' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:100',
            'tahun_pembuatan' => 'nullable|string|max:50',
            'pengguna_bangunan' => 'nullable|string|max:100',
            'tahun_instalasi' => 'nullable|string|max:50',
            'instalatir' => 'nullable|string|max:150',

            // Spesifikasi Bangunan
            'luas_lahan' => 'nullable|numeric',
            'luas_bangunan' => 'nullable|numeric',
            'tinggi_bangunan' => 'nullable|numeric',
            'luas_lantai' => 'nullable|numeric',
            'jumlah_lantai' => 'nullable|numeric',

            // Detail Perangkat
            'panel_control_mcfa' => 'nullable|string|max:150',
            'annuciator' => 'nullable|string|max:150',
            'detektor_panas_ror' => 'nullable|string|max:150',
            'jumlah_detektor_nyala_api_fix' => 'nullable|string|max:150',
            'detektor_asap' => 'nullable|string|max:150',
            'detektor_gas' => 'nullable|string|max:150',
            'tombol_manual_breakglass' => 'nullable|string|max:150',
            'combination_box' => 'nullable|string|max:150',

            // Detektor
            'jenis_detektor' => 'nullable|string|max:255',
            'lokasi_detektor' => 'nullable|string|max:255',
            'no_zone_detektor' => 'nullable|string|max:255',
            'hasil_detektor' => 'nullable|string|max:255',
            'open_circuit_test_detektor' => 'nullable|string|max:255',
            'keterangan_detektor' => 'nullable|string|max:255',
            'catatan_fire_alarm' => 'nullable|string|max:255',

            // Dokumen (Sigle File Uploads)
            'gambar_layout_gedung_perusahaan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'gambar_instalasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_spesifikasi_peralatan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_pemeliharaan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'surat_keterangan_berkala' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'laporan_pemeriksaan_berkala' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        // Konversi tanggal
        $validated['tanggal_pemeriksaan'] = $validated['tanggal_pemeriksaan'] 
            ? Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d') 
            : null;

        // Upload Foto Informasi Umum (Multiple)
        if ($request->hasFile('foto_informasi_umum')) {
            $paths = [];
            foreach ($request->file('foto_informasi_umum') as $file) {
                $paths[] = $file->store('ipk/instalasi_fire_alarm/foto_umum', 'public');
            }
            $validated['foto_informasi_umum'] = json_encode($paths);
        } else {
            $validated['foto_informasi_umum'] = null;
        }

        // Upload Dokumen (Single)
        $docFields = [
            'gambar_layout_gedung_perusahaan',
            'gambar_instalasi',
            'dokumen_spesifikasi_peralatan',
            'dokumen_pemeliharaan',
            'surat_keterangan_berkala',
            'laporan_pemeriksaan_berkala'
        ];

        foreach ($docFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('ipk/instalasi_fire_alarm/docs', 'public');
            } else {
                $validated[$field] = null;
            }
        }

        $validated['job_order_tool_id'] = $jobOrderToolId;
        $validated['job_order_id'] = $jobOrderTool->job_order_id;

        FormKpInstalasiFireAlarm::create($validated);

        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.ipk.instalasi_fire_alarm.index')->with('success', 'Form KP Instalasi Fire Alarm berhasil disimpan!');
    }

    public function show(FormKpInstalasiFireAlarm $formKpInstalasiFireAlarm)
    {
        $formKpInstalasiFireAlarm->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.ipk.instalasi_fire_alarm.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Instalasi Fire Alarm',
            'subtitle' => '',
            'formKpInstalasiFireAlarm' => $formKpInstalasiFireAlarm,
        ]);
    }

    public function edit(FormKpInstalasiFireAlarm $formKpInstalasiFireAlarm)
    {
        return view('form_kp.ipk.instalasi_fire_alarm.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Instalasi Fire Alarm',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpInstalasiFireAlarm' => $formKpInstalasiFireAlarm,
        ]);
    }

    public function update(Request $request, FormKpInstalasiFireAlarm $formKpInstalasiFireAlarm)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'foto_informasi_umum' => 'nullable|array',
            'foto_informasi_umum.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            
            // Informasi Umum
            'nama_perusahaan' => 'nullable|string|max:150',
            'kapasitas' => 'nullable|string|max:100',
            'model_unit' => 'nullable|string|max:100',
            'nomor_seri' => 'nullable|string|max:100',
            'pabrik_pembuat' => 'nullable|string|max:100',
            'jenis' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:100',
            'tahun_pembuatan' => 'nullable|string|max:50',
            'pengguna_bangunan' => 'nullable|string|max:100',
            'tahun_instalasi' => 'nullable|string|max:50',
            'instalatir' => 'nullable|string|max:150',

            // Spesifikasi Bangunan
            'luas_lahan' => 'nullable|numeric',
            'luas_bangunan' => 'nullable|numeric',
            'tinggi_bangunan' => 'nullable|numeric',
            'luas_lantai' => 'nullable|numeric',
            'jumlah_lantai' => 'nullable|numeric',

            // Detail Perangkat
            'panel_control_mcfa' => 'nullable|string|max:150',
            'annuciator' => 'nullable|string|max:150',
            'detektor_panas_ror' => 'nullable|string|max:150',
            'jumlah_detektor_nyala_api_fix' => 'nullable|string|max:150',
            'detektor_asap' => 'nullable|string|max:150',
            'detektor_gas' => 'nullable|string|max:150',
            'tombol_manual_breakglass' => 'nullable|string|max:150',
            'combination_box' => 'nullable|string|max:150',

            // Detektor
            'jenis_detektor' => 'nullable|string|max:255',
            'lokasi_detektor' => 'nullable|string|max:255',
            'no_zone_detektor' => 'nullable|string|max:255',
            'hasil_detektor' => 'nullable|string|max:255',
            'open_circuit_test_detektor' => 'nullable|string|max:255',
            'keterangan_detektor' => 'nullable|string|max:255',
            'catatan_fire_alarm' => 'nullable|string|max:255',

            // Dokumen (Sigle File Uploads)
            'gambar_layout_gedung_perusahaan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'gambar_instalasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_spesifikasi_peralatan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_pemeliharaan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'surat_keterangan_berkala' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'laporan_pemeriksaan_berkala' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        // konversi tanggal
        if ($validated['tanggal_pemeriksaan']) {
            $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
        }

        // Upload Foto Umum
        if ($request->hasFile('foto_informasi_umum')) {
            if ($formKpInstalasiFireAlarm->foto_informasi_umum) {
                $oldFiles = json_decode($formKpInstalasiFireAlarm->foto_informasi_umum, true) ?? [];
                foreach ($oldFiles as $oldFile) {
                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }
            }
            $paths = [];
            foreach ($request->file('foto_informasi_umum') as $file) {
                $paths[] = $file->store('ipk/instalasi_fire_alarm/foto_umum', 'public');
            }
            $validated['foto_informasi_umum'] = json_encode($paths);
        } else {
             unset($validated['foto_informasi_umum']); 
        }

        // Upload Doks
        $docFields = [
            'gambar_layout_gedung_perusahaan',
            'gambar_instalasi',
            'dokumen_spesifikasi_peralatan',
            'dokumen_pemeliharaan',
            'surat_keterangan_berkala',
            'laporan_pemeriksaan_berkala'
        ];

        foreach ($docFields as $field) {
            if ($request->hasFile($field)) {
                if ($formKpInstalasiFireAlarm->$field && Storage::disk('public')->exists($formKpInstalasiFireAlarm->$field)) {
                    Storage::disk('public')->delete($formKpInstalasiFireAlarm->$field);
                }
                $validated[$field] = $request->file($field)->store('ipk/instalasi_fire_alarm/docs', 'public');
            } else {
                unset($validated[$field]);
            }
        }

        $formKpInstalasiFireAlarm->update($validated);

        return redirect()->route('form_kp.ipk.instalasi_fire_alarm.index')
            ->with('success', 'Form KP Instalasi Fire Alarm berhasil diperbarui!');
    }
}
