<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpEskalator;
use Illuminate\Support\Facades\Storage;

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

        return view('form_kp.eskalator.eskalator.index', [
            'title' => 'Form KP Eskalator',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'eskalators' => $eskalators,
        ]);
    }

    public function create($jobOrderToolId)
    {
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.eskalator.eskalator.create', [
            'title' => 'Form KP Eskalator',
            'subtitle' => 'Isi Form KP Eskalator',
            'jobOrderTool' => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        dd($request->all());
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);

        // ✅ Validasi lengkap
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'nama_perusahaan' => 'nullable|string|max:255',
            'jenis_eskalator' => 'nullable|string|max:255',
            'merk_eskalator' => 'nullable|string|max:255',
            'nomor_seri' => 'nullable|string|max:255',
            'asal_negara_pembuat' => 'nullable|string|max:255',
            'tahun_pembuatan' => 'nullable|string|max:255',
            'kapasitas' => 'nullable|string|max:255',
            'melayani' => 'nullable|string|max:255',
            'lokasi_eskalator' => 'nullable|string|max:255',

            // Foto (array)
            'pagar_pelindung' => 'nullable|array',
            'pagar_pelindung.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'ban_pegangan_foto' => 'nullable|array',
            'ban_pegangan_foto.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'peralatan_pengaman_foto' => 'nullable|array',
            'peralatan_pengaman_foto.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            // Pemeriksaan Dimensi dan Keamanan
            'tinggi' => 'nullable|string|max:255',
            'tekanan_samping' => 'nullable|string|max:255',
            'tekanan_vertikal' => 'nullable|string|max:255',
            'pelindung_bawah' => 'nullable|string',
            'kelenturan_pelindung_bawah' => 'nullable|string',
            'celah_anak_tangga' => 'nullable|string',

            // Ban Pegangan
            'kecepatan_ban_pegangan' => 'nullable|string|max:255',
            'lebar_ban_pegangan' => 'nullable|string|max:255',

            // Catatan / deskripsi lain
            'catatan' => 'nullable|string',
        ]);

        // Konversi tanggal format d-m-Y → Y-m-d
        if (!empty($validated['tanggal_pemeriksaan'])) {
            $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
        }

        // ✅ Upload semua array foto
        $fotoFields = ['pagar_pelindung', 'ban_pegangan_foto', 'peralatan_pengaman_foto'];
        foreach ($fotoFields as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store("eskalator/{$field}", 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan relasi ke JobOrderTool
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data
        FormKpEskalator::create($validated);

        // Update status alat
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.eskalator.eskalator.index')->with('success', 'Form KP Eskalator berhasil disimpan!');
    }

    public function show(FormKpEskalator $formKpEskalator)
    {
        $formKpEskalator->load(['jobOrderTool.jobOrder', 'jobOrderTool.tool']);

        return view('form_kp.eskalator.eskalator.show', [
            'title' => 'Detail Pemeriksaan Eskalator',
            'subtitle' => '',
            'formKpEskalator' => $formKpEskalator,
        ]);
    }

    public function edit(FormKpEskalator $formKpEskalator)
    {
        return view('form_kp.eskalator.eskalator.edit', [
            'title' => 'Edit Form KP Eskalator',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpEskalator' => $formKpEskalator,
        ]);
    }

    public function update(Request $request, FormKpEskalator $formKpEskalator)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'nama_perusahaan' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',

            // ✅ Validasi foto array
            'pagar_pelindung' => 'nullable|array',
            'pagar_pelindung.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'ban_pegangan_foto' => 'nullable|array',
            'ban_pegangan_foto.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'peralatan_pengaman_foto' => 'nullable|array',
            'peralatan_pengaman_foto.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'foto_shell' => 'nullable|array',
            'foto_shell.*' => 'image|mimes:jpg,jpeg,png|max:10240',
        ]);


        if (!empty($validated['tanggal_pemeriksaan'])) {
            $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
        }

        // ✅ Upload ulang hanya kategori foto yang diubah
        $fotoFields = ['pagar_pelindung', 'ban_pegangan_foto', 'peralatan_pengaman_foto', 'foto_shell'];

        foreach ($fotoFields as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama hanya untuk field ini
                if ($formKpEskalator->$field) {
                    $oldFiles = is_string($formKpEskalator->$field)
                        ? json_decode($formKpEskalator->$field, true)
                        : $formKpEskalator->$field;

                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Simpan file baru
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store("eskalator/{$field}", 'public');
                }
                $validated[$field] = json_encode($paths);
            }
        }

        // ✅ Update field biasa
        $formKpEskalator->update($validated);

        return redirect()->route('form_kp.eskalator.eskalator.index', $formKpEskalator->id)
            ->with('success', 'Form KP Eskalator berhasil diperbarui!');
    }
}
