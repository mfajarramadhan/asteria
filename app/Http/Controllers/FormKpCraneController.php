<?php

namespace App\Http\Controllers;

use App\Models\FormKpCrane;
use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class FormKpCraneController extends Controller
{
    public function index()
    {
        $cranes = FormKpCrane::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 3)
                        ->where('sub_jenis_riksa_uji_id', 11);
                });
            })
            ->get();

        return view('form_kp.papa.crane.index', [
            'title' => 'Hasil Kartu Pemeriksaan Crane',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'cranes' => $cranes,
        ]);
    }

    public function search(Request $request)
    {
        $q = trim($request->q);

        $cranes = FormKpCrane::with([
                'jobOrderTool.jobOrder',
                'jobOrderTool.tool'
            ])
            ->when($q, function ($query) use ($q) {

                $query->where('tanggal_pemeriksaan', 'like', "%{$q}%")

                    ->orWhereHas('jobOrderTool.jobOrder', function ($q2) use ($q) {
                        $q2->where('nomor_jo', 'like', "%{$q}%")
                        ->orWhere('nama_perusahaan', 'like', "%{$q}%");
                    })

                    ->orWhereHas('jobOrderTool.tool', function ($q2) use ($q) {
                        $q2->where('nama', 'like', "%{$q}%");
                    })

                    ->orWhereHas('jobOrderTool', function ($q2) use ($q) {
                        $q2->where('status', 'like', "%{$q}%")
                        ->orWhere('status_tool', 'like', "%{$q}%");
                    });
            })
            ->latest()
            ->get();

        return response()->json($cranes);
    }

    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.papa.crane.create', [
            'title'         => 'Form Kartu Pemeriksaan Crane',
            'subtitle'         => 'Isi Form KP Crane',
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

            'tinggi_angkat_maksimum'    => 'nullable|numeric',
            'kecepatan_hosting'          => 'nullable|numeric',
            'kecepatan_treversing'       => 'nullable|numeric',
            'kecepatan_travelling'       => 'nullable|numeric',
            'panjang_span'               => 'nullable|numeric',

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

            // FOTO LOADTEST
            'foto_loadtest'              => 'nullable|array',
            'foto_loadtest.*'            => 'image|mimes:jpg,jpeg,png|max:10240',

            // LOAD TEST 1
            'swl_tinggi_angkat_hook1'   => 'nullable|string|max:25',
            'beban_uji_load_chard1'     => 'nullable|string|max:25',
            'travelling1'               => 'nullable|string|max:25',
            'traversing1'               => 'nullable|string|max:25',
            'hasil1'                     => 'nullable|string|max:25',
            'keterangan1'                => 'nullable|string',

            // LOAD TEST 2
            'swl_tinggi_angkat_hook2'   => 'nullable|string|max:25',
            'beban_uji_load_chard2'     => 'nullable|string|max:25',
            'travelling2'               => 'nullable|string|max:25',
            'traversing2'               => 'nullable|string|max:25',
            'hasil2'                     => 'nullable|string|max:25',
            'keterangan2'                => 'nullable|string',

            // LOAD TEST 3
            'swl_tinggi_angkat_hook3'   => 'nullable|string|max:25',
            'beban_uji_load_chard3'     => 'nullable|string|max:25',
            'travelling3'               => 'nullable|string|max:25',
            'traversing3'               => 'nullable|string|max:25',
            'hasil3'                     => 'nullable|string|max:25',
            'keterangan3'                => 'nullable|string',

            // FOTO DEFLEKSI
            'foto_defleksi'              => 'nullable|array',
            'foto_defleksi.*'            => 'image|mimes:jpg,jpeg,png|max:10240',
            'posisi_defleksi'            => 'nullable|string|max:255',
            'single_girder_beban'        => 'nullable|string|max:100',
            'single_girder_tanpa_beban' => 'nullable|string|max:100',
            'posisi_defleksi_dua'        => 'nullable|string|max:255',
            'double_girder_beban'        => 'nullable|string|max:100',
            'double_girder_tanpa_beban' => 'nullable|string|max:100',

            // CATATAN UMUM
            'catatan'                    => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum', 'foto_rantai', 'foto_wire_rope', 'foto_hook', 'foto_pulley', 'foto_loadtest', 'foto_defleksi'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('papa/crane', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpCrane::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.papa.crane.index')->with('success', 'Form KP Crane berhasil disimpan!');
    }

    public function show(FormKpCrane $formKpCrane)
    {
        // load relasi
        $formKpCrane->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.papa.crane.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Crane',
            'subtitle' => '',
            'formKpCrane' => $formKpCrane,
        ]);
    }

    public function edit(FormKpCrane $formKpCrane)
    {
        return view('form_kp.papa.crane.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Crane',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpCrane' => $formKpCrane,
        ]);
    }

    public function update(Request $request, FormKpCrane $formKpCrane)
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

            'tinggi_angkat_maksimum'    => 'nullable|numeric',
            'kecepatan_hosting'          => 'nullable|numeric',
            'kecepatan_treversing'       => 'nullable|numeric',
            'kecepatan_travelling'       => 'nullable|numeric',
            'panjang_span'               => 'nullable|numeric',

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

            // FOTO LOADTEST
            'foto_loadtest'              => 'nullable|array',
            'foto_loadtest.*'            => 'image|mimes:jpg,jpeg,png|max:10240',

            // LOAD TEST 1
            'swl_tinggi_angkat_hook1'   => 'nullable|string|max:25',
            'beban_uji_load_chard1'     => 'nullable|string|max:25',
            'travelling1'               => 'nullable|string|max:25',
            'traversing1'               => 'nullable|string|max:25',
            'hasil1'                     => 'nullable|string|max:25',
            'keterangan1'                => 'nullable|string',

            // LOAD TEST 2
            'swl_tinggi_angkat_hook2'   => 'nullable|string|max:25',
            'beban_uji_load_chard2'     => 'nullable|string|max:25',
            'travelling2'               => 'nullable|string|max:25',
            'traversing2'               => 'nullable|string|max:25',
            'hasil2'                     => 'nullable|string|max:25',
            'keterangan2'                => 'nullable|string',

            // LOAD TEST 3
            'swl_tinggi_angkat_hook3'   => 'nullable|string|max:25',
            'beban_uji_load_chard3'     => 'nullable|string|max:25',
            'travelling3'               => 'nullable|string|max:25',
            'traversing3'               => 'nullable|string|max:25',
            'hasil3'                     => 'nullable|string|max:25',
            'keterangan3'                => 'nullable|string',

            // FOTO DEFLEKSI
            'foto_defleksi'              => 'nullable|array',
            'foto_defleksi.*'            => 'image|mimes:jpg,jpeg,png|max:10240',
            'posisi_defleksi'            => 'nullable|string|max:255',
            'single_girder_beban'        => 'nullable|string|max:100',
            'single_girder_tanpa_beban' => 'nullable|string|max:100',
            'posisi_defleksi_dua'        => 'nullable|string|max:255',
            'double_girder_beban'        => 'nullable|string|max:100',
            'double_girder_tanpa_beban' => 'nullable|string|max:100',

            // CATATAN UMUM
            'catatan'                    => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum', 'foto_rantai', 'foto_wire_rope', 'foto_hook', 'foto_pulley', 'foto_loadtest', 'foto_defleksi'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpCrane->$field) {
                    $oldFiles = json_decode($formKpCrane->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('papa/crane', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpCrane->$field;
            }
        }

        $formKpCrane->update($validated);

        return redirect()->route('form_kp.papa.crane.index', $formKpCrane->id)
            ->with('success', 'Form KP Crane berhasil diperbarui!');
    }
}
