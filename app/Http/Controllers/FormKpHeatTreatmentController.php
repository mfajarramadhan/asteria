<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpHeatTreatment;
use Illuminate\Support\Facades\Storage;

class FormKpHeatTreatmentController extends Controller
{
    public function index()
    {
        $heatTreatments = FormKpHeatTreatment::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 2)
                        ->where('sub_jenis_riksa_uji_id', 7);
                });
            })
            ->get();

        return view('form_kp.ptp.heat_treatment.index', [
            'title' => 'Hasil Kartu Pemeriksaan Heat Treatment/Oven',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'heatTreatments' => $heatTreatments,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.ptp.heat_treatment.create', [
            'title'         => 'Form Kartu Pemeriksaan Heat Treatment/Oven',
            'subtitle'         => 'Isi Form KP Heat Treatment/Oven',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        // Validasi input
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'pabrik_pembuat'     => 'nullable|string|max:255',
            'foto_shell'          => 'nullable|array', 
            'foto_shell.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'ketidakbulatan'      => 'nullable|numeric',
            'ketebalan_shell'     => 'nullable|numeric',
            'diameter_shell'      => 'nullable|numeric',
            'panjang_shell'       => 'nullable|numeric',

            'foto_head'           => 'nullable|array',
            'foto_head.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_head'       => 'nullable|numeric',
            'ketebalan_head'      => 'nullable|numeric',

            'foto_pipa'           => 'nullable|array',
            'foto_pipa.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_pipa'       => 'nullable|numeric',
            'ketebalan_pipa'      => 'nullable|numeric',
            'panjang_pipa'        => 'nullable|numeric',

            'foto_instalasi'       => 'nullable|array',
            'foto_instalasi.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_instalasi'   => 'nullable|numeric',
            'ketebalan_instalasi'  => 'nullable|numeric',
            'panjang_instalasi'    => 'nullable|numeric',

            'safety_valv_cal'     => 'nullable|boolean',
            'tekanan_kerja'       => 'nullable|numeric',
            'set_safety_valv'     => 'nullable|numeric',

            'media_yang_diisikan' => 'nullable|string|max:255',
            'catatan'             => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_shell', 'foto_head', 'foto_pipa', 'foto_instalasi'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('ptp/heat_treatment', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpHeatTreatment::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.ptp.heat_treatment.index')->with('success', 'Form KP Heat Treatment/Oven berhasil disimpan!');
    }

    public function show(FormKpHeatTreatment $formKpHeatTreatment)
    {
        // load relasi
        $formKpHeatTreatment->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.ptp.heat_treatment.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Heat Treatment/Oven',
            'subtitle' => '',
            'FormKpHeatTreatment' => $formKpHeatTreatment,
        ]);
    }

    public function edit(FormKpHeatTreatment $formKpHeatTreatment)
    {
        return view('form_kp.ptp.heat_treatment.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Heat Treatment/Oven',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'FormKpHeatTreatment' => $formKpHeatTreatment,
        ]);
    }

    public function update(Request $request, FormKpHeatTreatment $formKpHeatTreatment)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'pabrik_pembuat'     => 'nullable|string|max:255',
            'foto_shell'          => 'nullable|array', 
            'foto_shell.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'ketidakbulatan'      => 'nullable|numeric',
            'ketebalan_shell'     => 'nullable|numeric',
            'diameter_shell'      => 'nullable|numeric',
            'panjang_shell'       => 'nullable|numeric',

            'foto_head'           => 'nullable|array',
            'foto_head.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_head'       => 'nullable|numeric',
            'ketebalan_head'      => 'nullable|numeric',

            'foto_pipa'           => 'nullable|array',
            'foto_pipa.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_pipa'       => 'nullable|numeric',
            'ketebalan_pipa'      => 'nullable|numeric',
            'panjang_pipa'        => 'nullable|numeric',

            'foto_instalasi'       => 'nullable|array',
            'foto_instalasi.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_instalasi'   => 'nullable|numeric',
            'ketebalan_instalasi'  => 'nullable|numeric',
            'panjang_instalasi'    => 'nullable|numeric',

            'safety_valv_cal'     => 'nullable|boolean',
            'tekanan_kerja'       => 'nullable|numeric',
            'set_safety_valv'     => 'nullable|numeric',

            'media_yang_diisikan' => 'nullable|string|max:255',
            'catatan'             => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_shell', 'foto_head', 'foto_pipa', 'foto_instalasi'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpHeatTreatment->$field) {
                    $oldFiles = json_decode($formKpHeatTreatment->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('ptp/heat_treatment', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpHeatTreatment->$field;
            }
        }

        $formKpHeatTreatment->update($validated);

        return redirect()->route('form_kp.ptp.heat_treatment.index', $formKpHeatTreatment->id)
            ->with('success', 'Form KP Heat Treatment/Oven berhasil diperbarui!');
    }
}
