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

    public function search(Request $request)
    {
        $q = trim($request->q);

        $eskalators = FormKpEskalator::with([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ])
            ->when($q, function ($query) use ($q) {

                $query->where('tanggal_pemeriksaan', 'like', "%{$q}%")

                    ->orWhereHas('jobOrderTool.jobOrder', function ($q2) use ($q) {
                        $q2->where('nomor_jo', 'like', "%{$q}%")
                            ->orWhere('nama_perusahaan', 'like', "%{$q}%");
                    })

                    ->orWhereHas('jobOrderTool.tool', function ($q2) use ($q) {
                        $q2->where('nama', 'like', "%{$q}%");
                    })

                    ->orWhereHas('jobOrderTool', function ($q2) use ($q) {
                        $q2->where('status', 'like', "%{$q}%")
                            ->orWhere('status_tool', 'like', "%{$q}%");
                    });
            })
            ->latest()
            ->get();

        return response()->json($eskalators);
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
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);

        // =========================
        // VALIDASI LENGKAP
        // =========================
        $validated = $request->validate([
            // Informasi umum
            'tanggal_pemeriksaan' => 'nullable|date',
            'nama_perusahaan' => 'nullable|string|max:255',
            'kapasitas' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'no_seri' => 'nullable|string|max:255',
            'pabrik_pembuat' => 'nullable|string|max:255',
            'jenis_eskalator' => 'nullable|string|max:255',
            'lokasi_eskalator' => 'nullable|string|max:255',
            'tahun_pembuatan' => 'nullable|string|max:255',
            'asal_negara_pembuat' => 'nullable|string|max:255',
            'melayani' => 'nullable|string|max:255',

            // =========================
            // FOTO (ARRAY)
            // =========================
            'foto_informasi_umum' => 'nullable|array',
            'foto_informasi_umum.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pagar_pelindung' => 'nullable|array',
            'pagar_pelindung.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'ban_pegangan_foto' => 'nullable|array',
            'ban_pegangan_foto.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'peralatan_pengaman_foto' => 'nullable|array',
            'peralatan_pengaman_foto.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            // =========================
            // PEMERIKSAAN DIMENSI & KEAMANAN
            // =========================
            'tinggi' => 'nullable|string|max:20',
            'tinggi_keterangan' => 'nullable|string',

            'tekanan_samping' => 'nullable|string|max:20',
            'tekanan_samping_keterangan' => 'nullable|string',

            'tekanan_vertikal' => 'nullable|string|max:20',
            'tekanan_vertikal_keterangan' => 'nullable|string',

            'pelindung_bawah' => 'nullable|string|max:255',
            'pelindung_bawah_keterangan' => 'nullable|string',

            'kelenturan_pelindung_bawah' => 'nullable|string|max:255',
            'kelenturan_pelindung_bawah_keterangan' => 'nullable|string',

            'celah_anak_tangga' => 'nullable|string|max:255',
            'celah_anak_tangga_keterangan' => 'nullable|string',

            // =========================
            // BAN PEGANGAN
            // =========================
            'kondisi_ban_pegangan' => 'nullable|string|max:255',
            'kondisi_ban_pegangan_keterangan' => 'nullable|string',

            'kecepatan_ban_pegangan' => 'nullable|string|max:20',
            'kecepatan_ban_pegangan_keterangan' => 'nullable|string',

            'lebar_ban_pegangan' => 'nullable|string|max:20',
            'lebar_ban_pegangan_keterangan' => 'nullable|string',

            // =========================
            // SISTEM PENGAMAN
            // =========================
            'kunci_pengendali' => 'nullable|string|max:255',
            'kunci_pengendali_keterangan' => 'nullable|string',

            'saklar_henti' => 'nullable|string|max:255',
            'saklar_henti_keterangan' => 'nullable|string',

            'pengaman_rantai' => 'nullable|string|max:255',
            'pengaman_rantai_keterangan' => 'nullable|string',

            'rantai_penarik' => 'nullable|string|max:255',
            'rantai_penarik_keterangan' => 'nullable|string',

            'pengaman_anak_tangga' => 'nullable|string|max:255',
            'pengaman_anak_tangga_keterangan' => 'nullable|string',

            'pengaman_ban_pegangan' => 'nullable|string|max:255',
            'pengaman_ban_pegangan_keterangan' => 'nullable|string',

            'pengaman_pencegah_balik_arah' => 'nullable|string|max:255',
            'pengaman_pencegah_balik_arah_keterangan' => 'nullable|string',

            'pengaman_area_masuk_ban' => 'nullable|string|max:255',
            'pengaman_area_masuk_ban_keterangan' => 'nullable|string',

            'pengaman_pelat_sisir' => 'nullable|string|max:255',
            'pengaman_pelat_sisir_keterangan' => 'nullable|string',

            'sikat_pelindung_dalam' => 'nullable|string|max:255',
            'sikat_pelindung_dalam_keterangan' => 'nullable|string',

            'tombol_penghenti' => 'nullable|string|max:255',
            'tombol_penghenti_keterangan' => 'nullable|string',
        ]);

        // =========================
        // KONVERSI TANGGAL
        // =========================
        if (!empty($validated['tanggal_pemeriksaan'])) {
            $validated['tanggal_pemeriksaan'] =
                Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])
                ->format('Y-m-d');
        }

        // =========================
        // UPLOAD FOTO (JSON)
        // =========================
        $fotoFields = [
            'foto_informasi_umum',
            'pagar_pelindung',
            'ban_pegangan_foto',
            'peralatan_pengaman_foto'
        ];

        foreach ($fotoFields as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store("eskalator/{$field}", 'public');
                }
                $validated[$field] = json_encode($paths);
            }
        }

        // =========================
        // RELASI JOB ORDER TOOL
        // =========================
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // =========================
        // SIMPAN DATA
        // =========================
        FormKpEskalator::create($validated);

        // =========================
        // UPDATE STATUS ALAT
        // =========================
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()
            ->route('form_kp.eskalator.eskalator.index')
            ->with('success', 'Form KP Eskalator berhasil disimpan!');
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
            'foto_informasi_umum' => 'nullable|array',
            'foto_informasi_umum.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pagar_pelindung' => 'nullable|array',
            'pagar_pelindung.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'ban_pegangan_foto' => 'nullable|array',
            'ban_pegangan_foto.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'peralatan_pengaman_foto' => 'nullable|array',
            'peralatan_pengaman_foto.*' => 'image|mimes:jpg,jpeg,png|max:10240',

        ]);


        if (!empty($validated['tanggal_pemeriksaan'])) {
            $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
        }

        // ✅ Upload ulang hanya kategori foto yang diubah
        $fotoFields = ['foto_informasi_umum', 'pagar_pelindung', 'ban_pegangan_foto', 'peralatan_pengaman_foto', 'foto_shell'];

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
