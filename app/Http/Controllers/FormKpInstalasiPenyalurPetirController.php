<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\FormKpInstalasiPenyalurPetir;

class FormKpInstalasiPenyalurPetirController extends Controller
{
    public function index()
    {
        $instalasiPenyalurPetirs = FormKpInstalasiPenyalurPetir::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 4)
                        ->where('sub_jenis_riksa_uji_id', 15);
                });
            })
            ->get();

        return view('form_kp.listrik.instalasi_penyalur_petir.index', [
            'title' => 'Hasil Kartu Pemeriksaan Instalasi Penyalur Petir',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'instalasiPenyalurPetirs' => $instalasiPenyalurPetirs,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.listrik.instalasi_penyalur_petir.create', [
            'title'         => 'Form Kartu Pemeriksaan Instalasi Penyalur Petir',
            'subtitle'         => 'Isi Form KP Instalasi Penyalur Petir',
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
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            'air_terminal1'                 => 'nullable|string|max:100',
            'air_terminal2'                 => 'nullable|string|max:100',
            'jarak_radius_proteksi'         => 'nullable|string|max:100',
            'tinggi_tiang'                  => 'nullable|string|max:100',
            'jumlah_dan_jarak'              => 'nullable|string|max:100',
            'keadaan_visual_air'            => 'nullable|string|max:100',

            'down_conductor'                => 'nullable|string|max:100',
            'jumlah_down_conductor'         => 'nullable|string|max:100',
            'jarak_antar_kaki_penerima'     => 'nullable|string|max:100',

            'titik_percabangan'             => 'nullable|string|max:100',
            'luas_penampang'                => 'nullable|string|max:100',
            'tebal_penampang'               => 'nullable|string|max:100',

            'jarak_antar_penghantar'        => 'nullable|string|max:100',
            'jenis_penghantar'              => 'nullable|string|max:100',
            'tinggi_bangunan'               => 'nullable|string|max:100',

            'luas_bangunan'                 => 'nullable|string|max:100',
            'earth_electrode'               => 'nullable|string|max:100',

            'batang_pita_mesh'              => 'nullable|string|max:100',
            'diameter_penampang'            => 'nullable|string|max:100',
            'kedalaman_elektroda'           => 'nullable|string|max:100',

            'catatan'                       => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('listrik/instalasi_penyalur_petir', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpInstalasiPenyalurPetir::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.listrik.instalasi_penyalur_petir.index')->with('success', 'Form KP Instalasi Penyalur Petir berhasil disimpan!');
    }

    public function show(FormKpInstalasiPenyalurPetir $formKpInstalasiPenyalurPetir)
    {
        // load relasi
        $formKpInstalasiPenyalurPetir->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.listrik.instalasi_penyalur_petir.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Instalasi Penyalur Petir',
            'subtitle' => '',
            'formKpInstalasiPenyalurPetir' => $formKpInstalasiPenyalurPetir,
        ]);
    }

    public function edit(FormKpInstalasiPenyalurPetir $formKpInstalasiPenyalurPetir)
    {
        return view('form_kp.listrik.instalasi_penyalur_petir.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Instalasi Penyalur Petir',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpInstalasiPenyalurPetir' => $formKpInstalasiPenyalurPetir,
        ]);
    }

    public function update(Request $request, FormKpInstalasiPenyalurPetir $formKpInstalasiPenyalurPetir)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan'           => 'nullable|date',
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            'air_terminal1'                 => 'nullable|string|max:100',
            'air_terminal2'                 => 'nullable|string|max:100',
            'jarak_radius_proteksi'         => 'nullable|string|max:100',
            'tinggi_tiang'                  => 'nullable|string|max:100',
            'jumlah_dan_jarak'              => 'nullable|string|max:100',
            'keadaan_visual_air'            => 'nullable|string|max:100',

            'down_conductor'                => 'nullable|string|max:100',
            'jumlah_down_conductor'         => 'nullable|string|max:100',
            'jarak_antar_kaki_penerima'     => 'nullable|string|max:100',

            'titik_percabangan'             => 'nullable|string|max:100',
            'luas_penampang'                => 'nullable|string|max:100',
            'tebal_penampang'               => 'nullable|string|max:100',

            'jarak_antar_penghantar'        => 'nullable|string|max:100',
            'jenis_penghantar'              => 'nullable|string|max:100',
            'tinggi_bangunan'               => 'nullable|string|max:100',

            'luas_bangunan'                 => 'nullable|string|max:100',
            'earth_electrode'               => 'nullable|string|max:100',

            'batang_pita_mesh'              => 'nullable|string|max:100',
            'diameter_penampang'            => 'nullable|string|max:100',
            'kedalaman_elektroda'           => 'nullable|string|max:100',

            'catatan'                       => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpInstalasiPenyalurPetir->$field) {
                    $oldFiles = json_decode($formKpInstalasiPenyalurPetir->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('listrik/instalasi_penyalur_petir', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpInstalasiPenyalurPetir->$field;
            }
        }

        $formKpInstalasiPenyalurPetir->update($validated);

        return redirect()->route('form_kp.listrik.instalasi_penyalur_petir.index', $formKpInstalasiPenyalurPetir->id)
            ->with('success', 'Form KP Instalasi Penyalur Petir berhasil diperbarui!');
    }
}
