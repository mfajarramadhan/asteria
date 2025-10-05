<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpScrewCompressor;
use Illuminate\Support\Facades\Storage;

class FormKpScrewCompressorController extends Controller
{
    public function index()
    {
        $screwCompressors = FormKpScrewCompressor::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 1)
                        ->where('sub_jenis_riksa_uji_id', 3);
                });
            })
            ->get();

        return view('form_kp.pubt.screw_compressor.index', [
            'title' => 'Form KP Screw Compressor',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'screwCompressors' => $screwCompressors,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.pubt.screw_compressor.create', [
            'title'         => 'Form KP Screw Compressor',
            'subtitle'         => 'Isi Form KP Screw Compressor',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        // dd($request->all());
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);

        // Validasi input
        $validated = $request->validate([
            'tanggal_pemeriksaan'              => 'nullable|date',
            'nama_perusahaan'                  => 'nullable|string|max:255',

            'foto_shell_separator'             => 'nullable|array',
            'foto_shell_separator.*'           => 'image|mimes:jpg,jpeg,png|max:10240',
            'ketebalan_shell_separator'        => 'nullable|numeric',
            'diameter_shell_separator'         => 'nullable|numeric',
            'panjang_shell_separator'          => 'nullable|numeric',

            'foto_instalasi_pipa'              => 'nullable|array',
            'foto_instalasi_pipa.*'            => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_instalasi_pipa'          => 'nullable|numeric',
            'ketebalan_instalasi_pipa'         => 'nullable|numeric',
            'panjang_instalasi_pipa'           => 'nullable|numeric',

            'foto_casing_screw'                => 'nullable|array',
            'foto_casing_screw.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_casing_screw'             => 'nullable|numeric',
            'lebar_casing_screw'               => 'nullable|numeric',
            'tinggi_casing_screw'              => 'nullable|numeric',

            'foto_pondasi_screw'               => 'nullable|array',
            'foto_pondasi_screw.*'             => 'image|mimes:jpg,jpeg,png|max:10240',
            'panjang_pondasi_screw'            => 'nullable|numeric',
            'lebar_pondasi_screw'              => 'nullable|numeric',

            'foto_safety_device'               => 'nullable|array',
            'foto_safety_device.*'             => 'image|mimes:jpg,jpeg,png|max:10240',
            'safety_valve_separator_membuka'   => 'nullable|numeric',
            'safety_valve_separator_menutup'   => 'nullable|numeric',
            'catatan_safety_valve'             => 'nullable|string',

            'foto_pressure_switch'             => 'nullable|array',
            'foto_pressure_switch.*'           => 'image|mimes:jpg,jpeg,png|max:10240',
            'pressure_switch_on_set'           => 'nullable|numeric',
            'pressure_switch_on_hasil'         => 'nullable|numeric',
            'pressure_switch_off_set'          => 'nullable|numeric',
            'pressure_switch_off_hasil'        => 'nullable|numeric',
            'catatan_pressure_switch'          => 'nullable|string',
            'catatan'                          => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_shell_separator', 'foto_instalasi_pipa', 'foto_casing_screw', 'foto_pondasi_screw', 'foto_safety_device', 'foto_pressure_switch'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('pubt/screw_compressor', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpScrewCompressor::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.pubt.screw_compressor.index')->with('success', 'Form KP Screw Compressor berhasil disimpan!');
    }

    public function show(FormKpScrewCompressor $formKpScrewCompressor)
    {
        // load relasi
        $formKpScrewCompressor->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.pubt.screw_compressor.show', [
            'title' => 'Detail Pemeriksaan Screw Compressor',
            'subtitle' => '',
            'formKpScrewCompressor' => $formKpScrewCompressor,
        ]);
    }

    public function edit(FormKpScrewCompressor $formKpScrewCompressor)
    {
        return view('form_kp.pubt.screw_compressor.edit', [
            'title' => 'Edit Form KP Screw Compressor',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpScrewCompressor' => $formKpScrewCompressor,
        ]);
    }

    public function update(Request $request, FormKpScrewCompressor $formKpScrewCompressor)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'nama_perusahaan'     => 'nullable|string|max:255',
            'foto_shell.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'ketidakbulatan'      => 'nullable|numeric',
            'catatan'             => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        if ($request->hasFile('foto_shell')) {
            // Hapus file lama
            if ($formKpScrewCompressor->foto_shell) {
                $oldFiles = is_string($formKpScrewCompressor->foto_shell)
                    ? json_decode($formKpScrewCompressor->foto_shell, true)
                    : $formKpScrewCompressor->foto_shell;

                foreach ($oldFiles as $oldFile) {
                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }
            }

            $paths = [];
            $files = $request->file('foto_shell');
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                $paths[] = $file->store('pubt/screw_compressor', 'public');
            }

        $validated['foto_shell'] = json_encode($paths);        }
        $formKpScrewCompressor->update($validated);

        return redirect()->route('form_kp.pubt.screw_compressor.index', $formKpScrewCompressor->id)
            ->with('success', 'Form KP Screw Compressor berhasil diperbarui!');
    }
}
