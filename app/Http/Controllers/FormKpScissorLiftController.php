<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpScissorLift;
use Illuminate\Support\Facades\Storage;

class FormKpScissorLiftController extends Controller
{
public function index()
{
    $scissorLifts = FormKpScissorLift::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
        ->whereHas('jobOrderTool', function ($q) {
            $q->where('status_tool', 'selesai')
              ->whereHas('tool', function ($q2) {
                  $q2->where('jenis_riksa_uji_id', 3)
                     ->where('sub_jenis_riksa_uji_id', 8);
              });
        })
        ->get();

    return view('form_kp.papa.scissor_lift.index', [
        'title' => 'Form KP Scissor Lift',
        'subtitle' => 'Daftar alat selesai diperiksa',
        'scissorLifts' => $scissorLifts,
    ]);
}


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.papa.scissor_lift.create', [
            'title'         => 'Form KP Scissor Lift',
            'subtitle'         => 'Isi Form KP Scissor Lift',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);

        // Validasi input
        $validated = $request->validate([
            'tanggal_pemeriksaan'           => 'nullable|date',
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'image|mimes:jpg,jpeg,png|max:10240',

            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            // DATA SCISSOR LIFT
            'kapasitas_angkat'              => 'nullable|string|max:50',
            'tinggi_angkat_maksimum'        => 'nullable|string|max:50',
            'kecepatan_angkat_naik'         => 'nullable|string|max:50',
            'kecepatan_angkat_turun'        => 'nullable|string|max:50',

            'tiang_penyangga_panjang'       => 'nullable|string|max:50',
            'tiang_penyangga_lebar'         => 'nullable|string|max:50',
            'tiang_penyangga_tebal'         => 'nullable|string|max:50',

            'platform_panjang'              => 'nullable|string|max:50',
            'platform_lebar'                => 'nullable|string|max:50',
            'platform_tinggi'               => 'nullable|string|max:50',

            'torak_hidrolik_dalam'          => 'nullable|string|max:50',
            'torak_hidrolik_luar'           => 'nullable|string|max:50',
            'torak_hidrolik_tinggi'         => 'nullable|string|max:50',

            'jig_panjang'                   => 'nullable|string|max:50',
            'jig_lebar'                     => 'nullable|string|max:50',
            'jig_tebal'                     => 'nullable|string|max:50',
            'jig_diameter'                  => 'nullable|string|max:50',

            'rem_macam'                     => 'nullable|string|max:50',
            'rem_type'                      => 'nullable|string|max:50',

            // ENGINE
            'foto_engine'                   => 'nullable|array',
            'foto_engine.*'                 => 'image|mimes:jpg,jpeg,png|max:10240',

            'item'                          => 'nullable|string|max:50',
            'voltage'                       => 'nullable|string|max:50',
            'daya'                          => 'nullable|string|max:50',
            'frequency'                     => 'nullable|string|max:50',
            'phase'                         => 'nullable|string|max:50',
            'arus'                          => 'nullable|string|max:50',
            'beban'                         => 'nullable|string|max:50',
            'putaran'                       => 'nullable|string|max:50',

            // LOAD TEST
            'foto_loadtest'                 => 'nullable|array',
            'foto_loadtest.*'               => 'image|mimes:jpg,jpeg,png|max:10240',

            'swl_tinggi_angkat1'            => 'nullable|string|max:50',
            'beban_uji_load_chard1'         => 'nullable|string|max:50',
            'lifting1'                      => 'nullable|string|max:50',
            'hasil1'                        => 'nullable|string|max:50',
            'keterangan1'                   => 'nullable|string|max:50',

            'swl_tinggi_angkat2'            => 'nullable|string|max:50',
            'beban_uji_load_chard2'         => 'nullable|string|max:50',
            'lifting2'                      => 'nullable|string|max:50',
            'hasil2'                        => 'nullable|string|max:50',
            'keterangan2'                   => 'nullable|string|max:50',
            'radius_putaran_kiri'           => 'nullable|string|max:25',

            'swl_tinggi_angkat3'            => 'nullable|string|max:50',
            'beban_uji_load_chard3'         => 'nullable|string|max:50',
            'lifting3'                      => 'nullable|string|max:50',
            'hasil3'                        => 'nullable|string|max:50',
            'keterangan3'                   => 'nullable|string|max:50',
            'catatan'                       => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum', 'foto_engine', 'foto_loadtest'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('papa/scissor_lift', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpScissorLift::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.papa.scissor_lift.index')->with('success', 'Form KP Scissor Lift berhasil disimpan!');
    }

    public function show(FormKpScissorLift $formKpScissorLift)
    {
        // load relasi
        $formKpScissorLift->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.papa.scissor_lift.show', [
            'title' => 'Detail Pemeriksaan Scissor Lift',
            'subtitle' => '',
            'formKpScissorLift' => $formKpScissorLift,
        ]);
    }

    public function edit(FormKpScissorLift $formKpScissorLift)
    {
        return view('form_kp.papa.scissor_lift.edit', [
            'title' => 'Edit Form KP Scissor Lift',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpScissorLift' => $formKpScissorLift,
        ]);
    }

    public function update(Request $request, FormKpScissorLift $formKpScissorLift)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan'           => 'nullable|date',
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'image|mimes:jpg,jpeg,png|max:10240',

            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            // DATA SCISSOR LIFT
            'kapasitas_angkat'              => 'nullable|string|max:50',
            'tinggi_angkat_maksimum'        => 'nullable|string|max:50',
            'kecepatan_angkat_naik'         => 'nullable|string|max:50',
            'kecepatan_angkat_turun'        => 'nullable|string|max:50',

            'tiang_penyangga_panjang'       => 'nullable|string|max:50',
            'tiang_penyangga_lebar'         => 'nullable|string|max:50',
            'tiang_penyangga_tebal'         => 'nullable|string|max:50',

            'platform_panjang'              => 'nullable|string|max:50',
            'platform_lebar'                => 'nullable|string|max:50',
            'platform_tinggi'               => 'nullable|string|max:50',

            'torak_hidrolik_dalam'          => 'nullable|string|max:50',
            'torak_hidrolik_luar'           => 'nullable|string|max:50',
            'torak_hidrolik_tinggi'         => 'nullable|string|max:50',

            'jig_panjang'                   => 'nullable|string|max:50',
            'jig_lebar'                     => 'nullable|string|max:50',
            'jig_tebal'                     => 'nullable|string|max:50',
            'jig_diameter'                  => 'nullable|string|max:50',

            'rem_macam'                     => 'nullable|string|max:50',
            'rem_type'                      => 'nullable|string|max:50',

            // ENGINE
            'foto_engine'                   => 'nullable|array',
            'foto_engine.*'                 => 'image|mimes:jpg,jpeg,png|max:10240',

            'item'                          => 'nullable|string|max:50',
            'voltage'                       => 'nullable|string|max:50',
            'daya'                          => 'nullable|string|max:50',
            'frequency'                     => 'nullable|string|max:50',
            'phase'                         => 'nullable|string|max:50',
            'arus'                          => 'nullable|string|max:50',
            'beban'                         => 'nullable|string|max:50',
            'putaran'                       => 'nullable|string|max:50',

            // LOAD TEST
            'foto_loadtest'                 => 'nullable|array',
            'foto_loadtest.*'               => 'image|mimes:jpg,jpeg,png|max:10240',

            'swl_tinggi_angkat1'            => 'nullable|string|max:50',
            'beban_uji_load_chard1'         => 'nullable|string|max:50',
            'lifting1'                      => 'nullable|string|max:50',
            'hasil1'                        => 'nullable|string|max:50',
            'keterangan1'                   => 'nullable|string|max:50',

            'swl_tinggi_angkat2'            => 'nullable|string|max:50',
            'beban_uji_load_chard2'         => 'nullable|string|max:50',
            'lifting2'                      => 'nullable|string|max:50',
            'hasil2'                        => 'nullable|string|max:50',
            'keterangan2'                   => 'nullable|string|max:50',
            'radius_putaran_kiri'           => 'nullable|string|max:25',

            'swl_tinggi_angkat3'            => 'nullable|string|max:50',
            'beban_uji_load_chard3'         => 'nullable|string|max:50',
            'lifting3'                      => 'nullable|string|max:50',
            'hasil3'                        => 'nullable|string|max:50',
            'keterangan3'                   => 'nullable|string|max:50',
            'catatan'                       => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum', 'foto_engine', 'foto_loadtest'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpScissorLift->$field) {
                    $oldFiles = json_decode($formKpScissorLift->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('papa/scissor_lift', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpScissorLift->$field;
            }
        }

        $formKpScissorLift->update($validated);

        return redirect()->route('form_kp.papa.scissor_lift.index', $formKpScissorLift->id)
            ->with('success', 'Form KP Scissor Lift berhasil diperbarui!');
    }
}
