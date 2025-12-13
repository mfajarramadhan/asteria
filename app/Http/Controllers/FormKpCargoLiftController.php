<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpCargoLift;
use Illuminate\Support\Facades\Storage;

class FormKpCargoLiftController extends Controller
{
    public function index()
    {
        $cargoLifts = FormKpCargoLift::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 3)
                        ->where('sub_jenis_riksa_uji_id', 13);
                });
            })
            ->get();

        return view('form_kp.papa.cargo_lift.index', [
            'title' => 'Hasil Kartu Pemeriksaan Cargo Lift',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'cargoLifts' => $cargoLifts,
        ]);
    }


    public function create($jobOrderToolId)
    { 
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.papa.cargo_lift.create', [
            'title'         => 'Form Kartu Pemeriksaan Cargo Lift',
            'subtitle'         => 'Isi Form KP Cargo Lift',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        // dd($request->all());
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        // Validasi input
        $validated = $request->validate([
            'tanggal_pemeriksaan'           => 'nullable|date',
            // FOTO INFORMASI UMUM
            'foto_informasi_umum'        => 'nullable|array',
            'foto_informasi_umum.*'      => 'image|mimes:jpg,jpeg,png|max:10240',

            'pabrik_pembuat'             => 'nullable|string|max:100',
            'jenis_alat'                 => 'nullable|string|max:100',
            'lokasi'                     => 'nullable|string|max:100',
            'tahun_pembuatan'            => 'nullable|string|max:100',

            'tinggi_angkat_meter'        => 'nullable|numeric',
            'tinggi_angkat_lantai'       => 'nullable|numeric',
            'kecepatan_angkat'           => 'nullable|numeric',
            'dimensi_pondasi'            => 'nullable|string|max:100',
            'dimensi_sangkar'            => 'nullable|string|max:100',
            'dimensi_ruang_luncur'       => 'nullable|string|max:100',

            // FOTO RANTAI
            'foto_rantai'                => 'nullable|array',
            'foto_rantai.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_rantai1'            => 'nullable|numeric',
            'panjang_rantai2'            => 'nullable|numeric',
            'panjang_rantai3'            => 'nullable|numeric',
            'panjang_rantai4'            => 'nullable|numeric',
            'panjang_rantai5'            => 'nullable|numeric',
            'panjang_rantai6'            => 'nullable|numeric',

            // FOTO WIRE ROPE
            'foto_wire_rope'             => 'nullable|array',
            'foto_wire_rope.*'           => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_wire_rope1'         => 'nullable|numeric',
            'panjang_wire_rope2'         => 'nullable|numeric',
            'panjang_wire_rope3'         => 'nullable|numeric',
            'panjang_wire_rope4'         => 'nullable|numeric',
            'panjang_wire_rope5'         => 'nullable|numeric',
            'panjang_wire_rope6'         => 'nullable|numeric',

            // FOTO HOOK
            'foto_hook'                  => 'nullable|array',
            'foto_hook.*'                => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_hookA'              => 'nullable|numeric',
            'panjang_hookAi'             => 'nullable|numeric',
            'panjang_hookHa'             => 'nullable|numeric',
            'panjang_hookB'              => 'nullable|numeric',
            'panjang_hookBi'             => 'nullable|numeric',
            'panjang_hookHb'             => 'nullable|numeric',
            'panjang_hookW_C'            => 'nullable|numeric',
            'panjang_hookD'              => 'nullable|numeric',

            // FOTO PULLEY
            'foto_pulley'                => 'nullable|array',
            'foto_pulley.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_pulleyA'            => 'nullable|numeric',
            'panjang_pulleyB'            => 'nullable|numeric',
            'panjang_pulleyC'            => 'nullable|numeric',
            'panjang_pulleyD'            => 'nullable|numeric',
            'panjang_pulleyE'            => 'nullable|numeric',

            // FOTO PERFORMANCE
            'foto_performance'           => 'nullable|array',
            'foto_performance.*'         => 'image|mimes:jpg,jpeg,png|max:10240',

            'hoisting_naik_turun1'       => 'nullable|string|max:100',
            'jenis_uji1'                 => 'nullable|string|max:100',
            'bobot_beban1'               => 'nullable|string|max:100',
            'indikasi_kerusakan1'        => 'nullable|string|max:100',
            'hasil_performance1'         => 'nullable|string|max:100',

            'hoisting_naik_turun2'       => 'nullable|string|max:100',
            'jenis_uji2'                 => 'nullable|string|max:100',
            'bobot_beban2'               => 'nullable|string|max:100',
            'indikasi_kerusakan2'        => 'nullable|string|max:100',
            'hasil_performance2'         => 'nullable|string|max:100',

            'hoisting_naik_turun3'       => 'nullable|string|max:100',
            'jenis_uji3'                 => 'nullable|string|max:100',
            'bobot_beban3'               => 'nullable|string|max:100',
            'indikasi_kerusakan3'        => 'nullable|string|max:100',
            'hasil_performance3'         => 'nullable|string|max:100',

            // FOTO LOADTEST
            'foto_loadtest'              => 'nullable|array',
            'foto_loadtest.*'            => 'image|mimes:jpg,jpeg,png|max:10240',

            // LOADTEST 1
            'statis_dinamis1'            => 'nullable|string|max:100',
            'tinggi_angkat_hook1'        => 'nullable|string|max:100',
            'swl_beban_uji1'             => 'nullable|string|max:100',
            'hoisting1'                  => 'nullable|string|max:100',
            'hasil1'                     => 'nullable|string|max:100',
            'keterangan1'                => 'nullable|string|max:100',

            // LOADTEST 2
            'statis_dinamis2'            => 'nullable|string|max:100',
            'tinggi_angkat_hook2'        => 'nullable|string|max:100',
            'swl_beban_uji2'             => 'nullable|string|max:100',
            'hoisting2'                  => 'nullable|string|max:100',
            'hasil2'                     => 'nullable|string|max:100',
            'keterangan2'                => 'nullable|string|max:100',

            // LOADTEST 3
            'statis_dinamis3'            => 'nullable|string|max:100',
            'tinggi_angkat_hook3'        => 'nullable|string|max:100',
            'swl_beban_uji3'             => 'nullable|string|max:100',
            'hoisting3'                  => 'nullable|string|max:100',
            'hasil3'                     => 'nullable|string|max:100',
            'keterangan3'                => 'nullable|string|max:100',

            // FOTO DEFLEKSI
            'foto_defleksi'              => 'nullable|array',
            'foto_defleksi.*'            => 'image|mimes:jpg,jpeg,png|max:10240',

            'posisi_defleksi'            => 'nullable|string|max:255',
            'single_girder_beban'        => 'nullable|string|max:100',
            'single_girder_tanpa_beban'  => 'nullable|string|max:100',
            'posisi_defleksi_dua'        => 'nullable|string|max:255',
            'double_girder_beban'        => 'nullable|string|max:100',
            'double_girder_tanpa_beban'  => 'nullable|string|max:100',
            'double_girder_beban_dua'        => 'nullable|string|max:100',
            'double_girder_tanpa_beban_dua'  => 'nullable|string|max:100',
            'pengujian_ntd'              => 'nullable|string|max:100',
            'hasil_uji'                  => 'nullable|string|max:100',

            'catatan'                    => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum', 'foto_rantai', 'foto_wire_rope', 'foto_hook', 'foto_pulley', 'foto_performance' ,'foto_loadtest', 'foto_defleksi'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('papa/cargo_lift', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpCargoLift::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.papa.cargo_lift.index')->with('success', 'Form KP Cargo Lift berhasil disimpan!');
    }

    public function show(FormKpCargoLift $formKpCargoLift)
    {
        // load relasi
        $formKpCargoLift->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.papa.cargo_lift.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Cargo Lift',
            'subtitle' => '',
            'formKpCargoLift' => $formKpCargoLift,
        ]);
    }

    public function edit(FormKpCargoLift $formKpCargoLift)
    {
        return view('form_kp.papa.cargo_lift.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Cargo Lift',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpCargoLift' => $formKpCargoLift,
        ]);
    }

    public function update(Request $request, FormKpCargoLift $formKpCargoLift)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan'           => 'nullable|date',
            // FOTO INFORMASI UMUM
            'foto_informasi_umum'        => 'nullable|array',
            'foto_informasi_umum.*'      => 'image|mimes:jpg,jpeg,png|max:10240',

            'pabrik_pembuat'             => 'nullable|string|max:100',
            'jenis_alat'                 => 'nullable|string|max:100',
            'lokasi'                     => 'nullable|string|max:100',
            'tahun_pembuatan'            => 'nullable|string|max:100',

            'tinggi_angkat_meter'        => 'nullable|numeric',
            'tinggi_angkat_lantai'       => 'nullable|numeric',
            'kecepatan_angkat'           => 'nullable|numeric',
            'dimensi_pondasi'            => 'nullable|string|max:100',
            'dimensi_sangkar'            => 'nullable|string|max:100',
            'dimensi_ruang_luncur'       => 'nullable|string|max:100',

            // FOTO RANTAI
            'foto_rantai'                => 'nullable|array',
            'foto_rantai.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_rantai1'            => 'nullable|numeric',
            'panjang_rantai2'            => 'nullable|numeric',
            'panjang_rantai3'            => 'nullable|numeric',
            'panjang_rantai4'            => 'nullable|numeric',
            'panjang_rantai5'            => 'nullable|numeric',
            'panjang_rantai6'            => 'nullable|numeric',

            // FOTO WIRE ROPE
            'foto_wire_rope'             => 'nullable|array',
            'foto_wire_rope.*'           => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_wire_rope1'         => 'nullable|numeric',
            'panjang_wire_rope2'         => 'nullable|numeric',
            'panjang_wire_rope3'         => 'nullable|numeric',
            'panjang_wire_rope4'         => 'nullable|numeric',
            'panjang_wire_rope5'         => 'nullable|numeric',
            'panjang_wire_rope6'         => 'nullable|numeric',

            // FOTO HOOK
            'foto_hook'                  => 'nullable|array',
            'foto_hook.*'                => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_hookA'              => 'nullable|numeric',
            'panjang_hookAi'             => 'nullable|numeric',
            'panjang_hookHa'             => 'nullable|numeric',
            'panjang_hookB'              => 'nullable|numeric',
            'panjang_hookBi'             => 'nullable|numeric',
            'panjang_hookHb'             => 'nullable|numeric',
            'panjang_hookW_C'            => 'nullable|numeric',
            'panjang_hookD'              => 'nullable|numeric',

            // FOTO PULLEY
            'foto_pulley'                => 'nullable|array',
            'foto_pulley.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_pulleyA'            => 'nullable|numeric',
            'panjang_pulleyB'            => 'nullable|numeric',
            'panjang_pulleyC'            => 'nullable|numeric',
            'panjang_pulleyD'            => 'nullable|numeric',
            'panjang_pulleyE'            => 'nullable|numeric',

            // FOTO PERFORMANCE
            'foto_performance'           => 'nullable|array',
            'foto_performance.*'         => 'image|mimes:jpg,jpeg,png|max:10240',

            'hoisting_naik_turun1'       => 'nullable|string|max:100',
            'jenis_uji1'                 => 'nullable|string|max:100',
            'bobot_beban1'               => 'nullable|string|max:100',
            'indikasi_kerusakan1'        => 'nullable|string|max:100',
            'hasil_performance1'         => 'nullable|string|max:100',

            'hoisting_naik_turun2'       => 'nullable|string|max:100',
            'jenis_uji2'                 => 'nullable|string|max:100',
            'bobot_beban2'               => 'nullable|string|max:100',
            'indikasi_kerusakan2'        => 'nullable|string|max:100',
            'hasil_performance2'         => 'nullable|string|max:100',

            'hoisting_naik_turun3'       => 'nullable|string|max:100',
            'jenis_uji3'                 => 'nullable|string|max:100',
            'bobot_beban3'               => 'nullable|string|max:100',
            'indikasi_kerusakan3'        => 'nullable|string|max:100',
            'hasil_performance3'         => 'nullable|string|max:100',

            // FOTO LOADTEST
            'foto_loadtest'              => 'nullable|array',
            'foto_loadtest.*'            => 'image|mimes:jpg,jpeg,png|max:10240',

            // LOADTEST 1
            'statis_dinamis1'            => 'nullable|string|max:100',
            'tinggi_angkat_hook1'        => 'nullable|string|max:100',
            'swl_beban_uji1'             => 'nullable|string|max:100',
            'hoisting1'                  => 'nullable|string|max:100',
            'hasil1'                     => 'nullable|string|max:100',
            'keterangan1'                => 'nullable|string|max:100',

            // LOADTEST 2
            'statis_dinamis2'            => 'nullable|string|max:100',
            'tinggi_angkat_hook2'        => 'nullable|string|max:100',
            'swl_beban_uji2'             => 'nullable|string|max:100',
            'hoisting2'                  => 'nullable|string|max:100',
            'hasil2'                     => 'nullable|string|max:100',
            'keterangan2'                => 'nullable|string|max:100',

            // LOADTEST 3
            'statis_dinamis3'            => 'nullable|string|max:100',
            'tinggi_angkat_hook3'        => 'nullable|string|max:100',
            'swl_beban_uji3'             => 'nullable|string|max:100',
            'hoisting3'                  => 'nullable|string|max:100',
            'hasil3'                     => 'nullable|string|max:100',
            'keterangan3'                => 'nullable|string|max:100',

            // FOTO DEFLEKSI
            'foto_defleksi'              => 'nullable|array',
            'foto_defleksi.*'            => 'image|mimes:jpg,jpeg,png|max:10240',

            'posisi_defleksi'            => 'nullable|string|max:255',
            'single_girder_beban'        => 'nullable|string|max:100',
            'single_girder_tanpa_beban'  => 'nullable|string|max:100',
            'posisi_defleksi_dua'        => 'nullable|string|max:255',
            'double_girder_beban'        => 'nullable|string|max:100',
            'double_girder_tanpa_beban'  => 'nullable|string|max:100',
            'double_girder_beban_dua'        => 'nullable|string|max:100',
            'double_girder_tanpa_beban_dua'  => 'nullable|string|max:100',
            'pengujian_ntd'              => 'nullable|string|max:100',
            'hasil_uji'                  => 'nullable|string|max:100',

            'catatan'                    => 'nullable|string',
    ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum', 'foto_rantai', 'foto_wire_rope', 'foto_hook', 'foto_pulley', 'foto_performance' ,'foto_loadtest', 'foto_defleksi'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpCargoLift->$field) {
                    $oldFiles = json_decode($formKpCargoLift->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('papa/cargo_lift', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpCargoLift->$field;
            }
        }

        $formKpCargoLift->update($validated);

        return redirect()->route('form_kp.papa.cargo_lift.index', $formKpCargoLift->id)
            ->with('success', 'Form KP Cargo Lift berhasil diperbarui!');
    }
}
