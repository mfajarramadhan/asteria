<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpTangkiTimbun;
use Illuminate\Support\Facades\Storage;

class FormKpTangkiTimbunController extends Controller
{
    public function index()
    {
        $tangkiTimbuns = FormKpTangkiTimbun::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 1)
                        ->where('sub_jenis_riksa_uji_id', 4);
                });
            })
            ->get();

        return view('form_kp.pubt.tangki_timbun.index', [
            'title' => 'Form KP Tangki Timbun',
            'subtitle' => 'Daftar alat yang selesai',
            'tangkiTimbuns' => $tangkiTimbuns,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.pubt.tangki_timbun.create', [
            'title'         => 'Form KP Tangki Timbun',
            'subtitle'         => 'Isi Form KP Tangki Timbun',
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
                $paths[] = $file->store('pubt/tangki_timbun', 'public');
            }
            $validated['foto_shell'] = json_encode($paths);
        } else {
            $validated['foto_shell'] = null;
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpTangkiTimbun::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.pubt.tangki_timbun.index')->with('success', 'Form KP Tangki Timbun berhasil disimpan!');
    }

    public function show(FormKpTangkiTimbun $formKpTangkiTimbun)
    {
        // load relasi
        $formKpTangkiTimbun->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.pubt.tangki_timbun.show', [
            'title' => 'Detail Pemeriksaan Tangki Timbun',
            'subtitle' => '',
            'formKpTangkiTimbun' => $formKpTangkiTimbun,
        ]);
    }

    public function edit(FormKpTangkiTimbun $formKpTangkiTimbun)
    {
        return view('form_kp.pubt.tangki_timbun.edit', [
            'title' => 'Edit Form KP Tangki Timbun',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpTangkiTimbun' => $formKpTangkiTimbun,
        ]);
    }

    public function update(Request $request, FormKpTangkiTimbun $formKpTangkiTimbun)
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
            if ($formKpTangkiTimbun->foto_shell) {
                $oldFiles = is_string($formKpTangkiTimbun->foto_shell)
                    ? json_decode($formKpTangkiTimbun->foto_shell, true)
                    : $formKpTangkiTimbun->foto_shell;

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
                $paths[] = $file->store('pubt/tangki_timbun', 'public');
            }

        $validated['foto_shell'] = json_encode($paths);        }
        $formKpTangkiTimbun->update($validated);

        return redirect()->route('form_kp.pubt.tangki_timbun.index', $formKpTangkiTimbun->id)
            ->with('success', 'Form KP Tangki Timbun berhasil diperbarui!');
    }
}
