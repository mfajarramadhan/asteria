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
            'pabrik_pembuat'                => 'nullable|string|max:255',
            'lokasi'                        => 'nullable|string|max:255',

            'foto_mesin'                    => 'nullable|array',
            'foto_mesin.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',

            'daya_mesin'                    => 'nullable|numeric',
            'jumlah_silinder'               => 'nullable|numeric',

            'foto_generator'                => 'nullable|array',
            'foto_generator.*'              => 'image|mimes:jpg,jpeg,png|max:10240',

            'foto_pengukuran'               => 'nullable|array',
            'foto_pengukuran.*'             => 'image|mimes:jpg,jpeg,png|max:10240',

            'grounding1'                    => 'nullable|string|max:255',
            'grounding2'                    => 'nullable|string|max:255',
            'pondasi'                       => 'nullable|string|max:255',
            'rangka'                        => 'nullable|string|max:255',
            'cover_kipas'                   => 'nullable|string|max:255',
            'pencahayaan_depan'             => 'nullable|string|max:255',
            'pencahayaan_belakang'          => 'nullable|string|max:255',
            'pencahayaan_tengah'            => 'nullable|string|max:255',
            'pencahayaan_depan_panel'       => 'nullable|string|max:255',
            'kebisingan_ruang_pltd'         => 'nullable|string|max:255',
            'kebisingan_ruang_kontrol'      => 'nullable|string|max:255',
            'kebisingan_luar_ruang_pltd'    => 'nullable|string|max:255',
            'kebisingan_area_kerja'         => 'nullable|string|max:255',

            'foto_pengujian'                => 'nullable|array',
            'foto_pengujian.*'              => 'image|mimes:jpg,jpeg,png|max:10240',

            'emergency_stop'                => 'nullable|string|max:255',
            'emergency_stop_ket'            => 'nullable|string|max:255',
            'catatan'                       => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_mesin', 'foto_generator', 'foto_pengukuran', 'foto_pengujian'] as $field) {
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
            'pabrik_pembuat'                => 'nullable|string|max:255',
            'lokasi'                        => 'nullable|string|max:255',

            'foto_mesin'                    => 'nullable|array',
            'foto_mesin.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',

            'daya_mesin'                    => 'nullable|numeric',
            'jumlah_silinder'               => 'nullable|numeric',

            'foto_generator'                => 'nullable|array',
            'foto_generator.*'              => 'image|mimes:jpg,jpeg,png|max:10240',

            'foto_pengukuran'               => 'nullable|array',
            'foto_pengukuran.*'             => 'image|mimes:jpg,jpeg,png|max:10240',

            'grounding1'                    => 'nullable|string|max:255',
            'grounding2'                    => 'nullable|string|max:255',
            'pondasi'                       => 'nullable|string|max:255',
            'rangka'                        => 'nullable|string|max:255',
            'cover_kipas'                   => 'nullable|string|max:255',
            'pencahayaan_depan'             => 'nullable|string|max:255',
            'pencahayaan_belakang'          => 'nullable|string|max:255',
            'pencahayaan_tengah'            => 'nullable|string|max:255',
            'pencahayaan_depan_panel'       => 'nullable|string|max:255',
            'kebisingan_ruang_pltd'         => 'nullable|string|max:255',
            'kebisingan_ruang_kontrol'      => 'nullable|string|max:255',
            'kebisingan_luar_ruang_pltd'    => 'nullable|string|max:255',
            'kebisingan_area_kerja'         => 'nullable|string|max:255',

            'foto_pengujian'                => 'nullable|array',
            'foto_pengujian.*'              => 'image|mimes:jpg,jpeg,png|max:10240',

            'emergency_stop'                => 'nullable|string|max:255',
            'emergency_stop_ket'            => 'nullable|string|max:255',
            'catatan'                       => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_mesin', 'foto_generator', 'foto_pengukuran', 'foto_pengujian'] as $field) {
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
