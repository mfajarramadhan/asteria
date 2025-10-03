<?php

namespace App\Http\Controllers;

use App\Models\FormKpEskalator;
use Illuminate\Http\Request;

class FormKpEskalatorController extends Controller
{
    public function index()
    {
        $eskalators = FormKpEskalator::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                    ->whereHas('tool', function ($q2) {
                        $q2->where('jenis_riksa_uji_id', 5)
                            ->where('sub_jenis_riksa_uji_id', 16);
                    });
            })
            ->get();

        return view('form_kp.pubt.bejana_tekan.index', [
            'title' => 'Form KP Bejana Tekan',
            'subtitle' => 'Daftar alat yang selesai',
            'eskalators' => $eskalators,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.pubt.bejana_tekan.create', [
            'title'         => 'Form KP Bejana Tekan',
            'subtitle'         => 'Isi Form KP Bejana Tekan',
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
                $paths[] = $file->store('pubt/bejana_tekan', 'public');
            }
            $validated['foto_shell'] = json_encode($paths);
        } else {
            $validated['foto_shell'] = null;
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpEskalator::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.pubt.bejana_tekan.index')->with('success', 'Form KP Bejana Tekan berhasil disimpan!');
    }

    public function show(FormKpEskalator $formKpEskalator)
    {
        // load relasi
        $formKpEskalator->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.pubt.bejana_tekan.show', [
            'title' => 'Detail Pemeriksaan Bejana Tekan',
            'subtitle' => '',
            'formKpEskalator' => $formKpEskalator,
        ]);
    }

    public function edit(FormKpEskalator $formKpEskalator)
    {
        return view('form_kp.pubt.bejana_tekan.edit', [
            'title' => 'Edit Form KP Bejana Tekan',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpEskalator' => $formKpEskalator,
        ]);
    }

    public function update(Request $request, FormKpEskalator $formKpEskalator)
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
            if ($formKpEskalator->foto_shell) {
                $oldFiles = is_string($formKpEskalator->foto_shell)
                    ? json_decode($formKpEskalator->foto_shell, true)
                    : $formKpEskalator->foto_shell;

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
                $paths[] = $file->store('pubt/bejana_tekan', 'public');
            }

            $validated['foto_shell'] = json_encode($paths);
        }
        $formKpEskalator->update($validated);

        return redirect()->route('form_kp.pubt.bejana_tekan.index', $formKpEskalator->id)
            ->with('success', 'Form KP Bejana Tekan berhasil diperbarui!');
    }
}
