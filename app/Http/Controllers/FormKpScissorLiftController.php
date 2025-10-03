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
        'subtitle' => 'Daftar alat yang selesai',
        'scissorLifts' => $scissorLifts,
    ]);
}


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form-kp.papa.scissor-lift.create', [
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
            'tanggal_pemeriksaan' => 'nullable|date',
            'nama_perusahaan'     => 'nullable|string|max:255',
            'foto_shell'          => 'nullable|array', 
            'foto_shell.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'ketidakbulatan'      => 'nullable|numeric',
            'catatan'             => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file foto_shell jika ada
        if ($request->hasFile('foto_shell')) {
            $paths = [];
            foreach ($request->file('foto_shell') as $file) {
                $paths[] = $file->store('papa/scissor_lift', 'public');
            }
            $validated['foto_shell'] = json_encode($paths);
        } else {
            $validated['foto_shell'] = null;
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

        return view('form-kp.papa.scissor-lift.show', [
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
            if ($formKpScissorLift->foto_shell) {
                $oldFiles = is_string($formKpScissorLift->foto_shell)
                    ? json_decode($formKpScissorLift->foto_shell, true)
                    : $formKpScissorLift->foto_shell;

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
                $paths[] = $file->store('papa/scissor_lift', 'public');
            }

        $validated['foto_shell'] = json_encode($paths);        }
        $formKpScissorLift->update($validated);

        return redirect()->route('form_kp.papa.scissor_lift.index', $formKpScissorLift->id)
            ->with('success', 'Form KP Scissor Lift berhasil diperbarui!');
    }
}
