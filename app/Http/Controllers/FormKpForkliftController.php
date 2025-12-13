<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormKpForklift;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\JobOrderTool;

class FormKpForkliftController extends Controller
{
    public function index()
    {
        $forklifts = FormKpForklift::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 3)
                        ->where('sub_jenis_riksa_uji_id', 12);
                });
            })
            ->get();

        return view('form_kp.papa.forklift.index', [
            'title' => 'Hasil Kartu Pemeriksaan Forklift',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'forklifts' => $forklifts,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.papa.forklift.create', [
            'title'         => 'Form Kartu Pemeriksaan Forklift',
            'subtitle'         => 'Isi Form KP Forklift',
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
            // FOTO & INFORMASI UMUM
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            // KECEPATAN
            'foto_kecepatan'                => 'nullable|array',
            'foto_kecepatan.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'kecepatan_angkat'              => 'nullable|string|max:25',
            'kecepatan_ungkit'              => 'nullable|string|max:25',
            'kecepatan_jalan'               => 'nullable|string|max:25',

            // UMUM & OPERATOR
            'foto_radius'                   => 'nullable|array',
            'foto_radius.*'                 => 'image|mimes:jpg,jpeg,png|max:10240',
            'radius_putaran_kiri'           => 'nullable|string|max:25',
            'radius_putaran_kanan'          => 'nullable|string|max:25',
            'penggerak'                     => 'nullable|string|max:100',
            'nama_operator'                 => 'nullable|string|max:100',
            'sertifikat_operator_sio'       => 'nullable|string|max:100',

            // DIMENSI FORKLIFT
            'foto_dimensi_forklift'         => 'nullable|array',
            'foto_dimensi_forklift.*'       => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_dimensi_forklift'      => 'nullable|string|max:25',
            'lebar_dimensi_forklift'        => 'nullable|string|max:25',
            'tinggi_dimensi_forklift'       => 'nullable|string|max:25',

            // DIMENSI GARPU
            'foto_garpu'                    => 'nullable|array',
            'foto_garpu.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',
            'tinggi_garpu'                  => 'nullable|string|max:50',
            'lebar_garpu'                   => 'nullable|string|max:50',
            'tebal_garpu1'                  => 'nullable|string|max:50',
            'tebal_garpu2'                  => 'nullable|string|max:50',
            'tebal_garpu3'                  => 'nullable|string|max:50',

            // BACK REST (PAGAR)
            'foto_pagar'                    => 'nullable|array',
            'foto_pagar.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',
            'tinggi_pagar'                  => 'nullable|string|max:50',
            'lebar_pagar'                   => 'nullable|string|max:50',

            // MAST (TIANG)
            'foto_mast'                     => 'nullable|array',
            'foto_mast.*'                   => 'image|mimes:jpg,jpeg,png|max:10240',
            'tinggi_mast'                   => 'nullable|string|max:50',
            'lebar_mast'                    => 'nullable|string|max:50',
            'tebal_mast'                    => 'nullable|string|max:50',

            // TORAK
            'foto_torak'                    => 'nullable|array',
            'foto_torak.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',
            'torak_dalam'                   => 'nullable|string|max:50',
            'torak_luar'                    => 'nullable|string|max:50',
            'tinggi_torak'                  => 'nullable|string|max:50',

            // JARAK RODA
            'foto_jarak_antarroda'          => 'nullable|array',
            'foto_jarak_antarroda.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'jarak_roda_depan'              => 'nullable|string|max:50',
            'jarak_roda_belakang'           => 'nullable|string|max:50',
            'jarak_as_roda_depan_belakang'  => 'nullable|string|max:50',

            // LOAD TEST
            'foto_load_test'                => 'nullable|array',
            'foto_load_test.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'tinggi_angkat_hook1'           => 'nullable|string|max:100',
            'swl_beban_uji1'                => 'nullable|string|max:100',
            'travelling_kecepatan1'         => 'nullable|string|max:100',
            'gerakan1'                       => 'nullable|string|max:100',
            'hasil1'                         => 'nullable|string|max:100',
            'keterangan1'                    => 'nullable|string|max:100',

            'tinggi_angkat_hook2'           => 'nullable|string|max:100',
            'swl_beban_uji2'                => 'nullable|string|max:100',
            'travelling_kecepatan2'         => 'nullable|string|max:100',
            'gerakan2'                       => 'nullable|string|max:100',
            'hasil2'                         => 'nullable|string|max:100',
            'keterangan2'                    => 'nullable|string|max:100',

            'tinggi_angkat_hook3'           => 'nullable|string|max:100',
            'swl_beban_uji3'                => 'nullable|string|max:100',
            'travelling_kecepatan3'         => 'nullable|string|max:100',
            'gerakan3'                       => 'nullable|string|max:100',
            'hasil3'                         => 'nullable|string|max:100',
            'keterangan3'                    => 'nullable|string|max:100',

            // CATATAN
            'catatan'                        => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum', 'foto_kecepatan', 'foto_radius', 'foto_dimensi_forklift', 'foto_garpu', 'foto_pagar', 'foto_mast', 'foto_torak', 'foto_jarak_antarroda', 'foto_load_test'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('papa/forklift', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpForklift::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.papa.forklift.index')->with('success', 'Form KP Forklift berhasil disimpan!');
    }

    public function show(FormKpForklift $formKpForklift)
    {
        // load relasi
        $formKpForklift->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.papa.forklift.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Forklift',
            'subtitle' => '',
            'formKpForklift' => $formKpForklift,
        ]);
    }

    public function edit(FormKpForklift $formKpForklift)
    {
        return view('form_kp.papa.forklift.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Forklift',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpForklift' => $formKpForklift,
        ]);
    }

    public function update(Request $request, FormKpForklift $formKpForklift)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan'           => 'nullable|date',
            // FOTO & INFORMASI UMUM
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            // KECEPATAN
            'foto_kecepatan'                => 'nullable|array',
            'foto_kecepatan.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'kecepatan_angkat'              => 'nullable|string|max:25',
            'kecepatan_ungkit'              => 'nullable|string|max:25',
            'kecepatan_jalan'               => 'nullable|string|max:25',

            // UMUM & OPERATOR
            'foto_radius'                   => 'nullable|array',
            'foto_radius.*'                 => 'image|mimes:jpg,jpeg,png|max:10240',
            'radius_putaran_kiri'           => 'nullable|string|max:25',
            'radius_putaran_kanan'          => 'nullable|string|max:25',
            'penggerak'                     => 'nullable|string|max:100',
            'nama_operator'                 => 'nullable|string|max:100',
            'sertifikat_operator_sio'       => 'nullable|string|max:100',

            // DIMENSI FORKLIFT
            'foto_dimensi_forklift'         => 'nullable|array',
            'foto_dimensi_forklift.*'       => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_dimensi_forklift'      => 'nullable|string|max:25',
            'lebar_dimensi_forklift'        => 'nullable|string|max:25',
            'tinggi_dimensi_forklift'       => 'nullable|string|max:25',

            // DIMENSI GARPU
            'foto_garpu'                    => 'nullable|array',
            'foto_garpu.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',
            'tinggi_garpu'                  => 'nullable|string|max:50',
            'lebar_garpu'                   => 'nullable|string|max:50',
            'tebal_garpu1'                  => 'nullable|string|max:50',
            'tebal_garpu2'                  => 'nullable|string|max:50',
            'tebal_garpu3'                  => 'nullable|string|max:50',

            // BACK REST (PAGAR)
            'foto_pagar'                    => 'nullable|array',
            'foto_pagar.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',
            'tinggi_pagar'                  => 'nullable|string|max:50',
            'lebar_pagar'                   => 'nullable|string|max:50',

            // MAST (TIANG)
            'foto_mast'                     => 'nullable|array',
            'foto_mast.*'                   => 'image|mimes:jpg,jpeg,png|max:10240',
            'tinggi_mast'                   => 'nullable|string|max:50',
            'lebar_mast'                    => 'nullable|string|max:50',
            'tebal_mast'                    => 'nullable|string|max:50',

            // TORAK
            'foto_torak'                    => 'nullable|array',
            'foto_torak.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',
            'torak_dalam'                   => 'nullable|string|max:50',
            'torak_luar'                    => 'nullable|string|max:50',
            'tinggi_torak'                  => 'nullable|string|max:50',

            // JARAK RODA
            'foto_jarak_antarroda'          => 'nullable|array',
            'foto_jarak_antarroda.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'jarak_roda_depan'              => 'nullable|string|max:50',
            'jarak_roda_belakang'           => 'nullable|string|max:50',
            'jarak_as_roda_depan_belakang'  => 'nullable|string|max:50',

            // LOAD TEST
            'foto_load_test'                => 'nullable|array',
            'foto_load_test.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'tinggi_angkat_hook1'           => 'nullable|string|max:100',
            'swl_beban_uji1'                => 'nullable|string|max:100',
            'travelling_kecepatan1'         => 'nullable|string|max:100',
            'gerakan1'                       => 'nullable|string|max:100',
            'hasil1'                         => 'nullable|string|max:100',
            'keterangan1'                    => 'nullable|string|max:100',

            'tinggi_angkat_hook2'           => 'nullable|string|max:100',
            'swl_beban_uji2'                => 'nullable|string|max:100',
            'travelling_kecepatan2'         => 'nullable|string|max:100',
            'gerakan2'                       => 'nullable|string|max:100',
            'hasil2'                         => 'nullable|string|max:100',
            'keterangan2'                    => 'nullable|string|max:100',

            'tinggi_angkat_hook3'           => 'nullable|string|max:100',
            'swl_beban_uji3'                => 'nullable|string|max:100',
            'travelling_kecepatan3'         => 'nullable|string|max:100',
            'gerakan3'                       => 'nullable|string|max:100',
            'hasil3'                         => 'nullable|string|max:100',
            'keterangan3'                    => 'nullable|string|max:100',

            // CATATAN
            'catatan'                        => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum', 'foto_kecepatan', 'foto_radius', 'foto_dimensi_forklift', 'foto_garpu', 'foto_pagar', 'foto_mast', 'foto_torak', 'foto_jarak_antarroda', 'foto_load_test'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpForklift->$field) {
                    $oldFiles = json_decode($formKpForklift->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('papa/forklift', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpForklift->$field;
            }
        }

        $formKpForklift->update($validated);

        return redirect()->route('form_kp.papa.forklift.index', $formKpForklift->id)
            ->with('success', 'Form KP Forklift berhasil diperbarui!');
    }
}
