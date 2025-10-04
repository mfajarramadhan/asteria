<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use App\Models\FormKpKatelUap;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class FormKpKatelUapController extends Controller
{
    public function index()
    {
        $katelUaps = FormKpKatelUap::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 1)
                        ->where('sub_jenis_riksa_uji_id', 2);
                });
            })
            ->get();

        return view('form_kp.pubt.katel_uap.index', [
            'title' => 'Form KP Katel Uap',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'katelUaps' => $katelUaps,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.pubt.katel_uap.create', [
            'title'         => 'Form KP Katel Uap',
            'subtitle'         => 'Isi Form KP Katel Uap',
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
                $paths[] = $file->store('pubt/katel_uap', 'public');
            }
            $validated['foto_shell'] = json_encode($paths);
        } else {
            $validated['foto_shell'] = null;
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpKatelUap::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.pubt.katel_uap.index')->with('success', 'Form KP Katel Uap berhasil disimpan!');
    }

    public function show(FormKpKatelUap $formKpKatelUap)
    {
        // load relasi
        $formKpKatelUap->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.pubt.katel_uap.show', [
            'title' => 'Detail Pemeriksaan Katel Uap',
            'subtitle' => '',
            'formKpKatelUap' => $formKpKatelUap,
        ]);
    }

    public function edit(FormKpKatelUap $formKpKatelUap)
    {
        return view('form_kp.pubt.katel_uap.edit', [
            'title' => 'Edit Form KP Katel Uap',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpKatelUap' => $formKpKatelUap,
        ]);
    }

    public function update(Request $request, FormKpKatelUap $formKpKatelUap)
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
            if ($formKpKatelUap->foto_shell) {
                $oldFiles = is_string($formKpKatelUap->foto_shell)
                    ? json_decode($formKpKatelUap->foto_shell, true)
                    : $formKpKatelUap->foto_shell;

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
                $paths[] = $file->store('pubt/katel_uap', 'public');
            }

        $validated['foto_shell'] = json_encode($paths);        }
        $formKpKatelUap->update($validated);

        return redirect()->route('form_kp.pubt.katel_uap.index', $formKpKatelUap->id)
            ->with('success', 'Form KP Katel Uap berhasil diperbarui!');
    }
}
