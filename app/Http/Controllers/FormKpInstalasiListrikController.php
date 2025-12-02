<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpInstalasiListrik;
use Illuminate\Support\Facades\Storage;

class FormKpInstalasiListrikController extends Controller
{
    public function index()
    {
        $instalasiListriks = FormKpInstalasiListrik::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 4)
                        ->where('sub_jenis_riksa_uji_id', 14);
                });
            })
            ->get();

        return view('form_kp.listrik.instalasi_listrik.index', [
            'title' => 'Hasil Kartu Pemeriksaan Instalasi Listrik',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'instalasiListriks' => $instalasiListriks,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.listrik.instalasi_listrik.create', [
            'title'         => 'Form Kartu Pemeriksaan Instalasi Listrik',
            'subtitle'         => 'Isi Form KP Instalasi Listrik',
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

            // FOTO INFORMASI UMUM
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'nama_mesin'                    => 'nullable|string|max:255',
            'fungsi'                        => 'nullable|string|max:255',
            'lokasi'                        => 'nullable|string|max:255',

            // FOTO DEVICE
            'foto_device'                   => 'nullable|array',
            'foto_device.*'                 => 'image|mimes:jpg,jpeg,png|max:10240',

            // SAFETY DEVICE 1–10
            'safety_device1'                => 'nullable|string|max:255',
            'safety_device2'                => 'nullable|string|max:255',
            'safety_device3'                => 'nullable|string|max:255',
            'safety_device4'                => 'nullable|string|max:255',
            'safety_device5'                => 'nullable|string|max:255',
            'safety_device6'                => 'nullable|string|max:255',
            'safety_device7'                => 'nullable|string|max:255',
            'safety_device8'                => 'nullable|string|max:255',
            'safety_device9'                => 'nullable|string|max:255',
            'safety_device10'               => 'nullable|string|max:255',

            // KOMPONEN UTAMA 1–10
            'komponen_utama1'               => 'nullable|string|max:255',
            'komponen_utama2'               => 'nullable|string|max:255',
            'komponen_utama3'               => 'nullable|string|max:255',
            'komponen_utama4'               => 'nullable|string|max:255',
            'komponen_utama5'               => 'nullable|string|max:255',
            'komponen_utama6'               => 'nullable|string|max:255',
            'komponen_utama7'               => 'nullable|string|max:255',
            'komponen_utama8'               => 'nullable|string|max:255',
            'komponen_utama9'               => 'nullable|string|max:255',
            'komponen_utama10'              => 'nullable|string|max:255',

            // PENDUKUNG MESIN 1–10
            'pendukung_mesin1'              => 'nullable|string|max:255',
            'pendukung_mesin2'              => 'nullable|string|max:255',
            'pendukung_mesin3'              => 'nullable|string|max:255',
            'pendukung_mesin4'              => 'nullable|string|max:255',
            'pendukung_mesin5'              => 'nullable|string|max:255',
            'pendukung_mesin6'              => 'nullable|string|max:255',
            'pendukung_mesin7'              => 'nullable|string|max:255',
            'pendukung_mesin8'              => 'nullable|string|max:255',
            'pendukung_mesin9'              => 'nullable|string|max:255',
            'pendukung_mesin10'             => 'nullable|string|max:255',

            // FOTO PENGUKURAN
            'foto_pengukuran'               => 'nullable|array',
            'foto_pengukuran.*'             => 'image|mimes:jpg,jpeg,png|max:10240',

            // DATA PENGUKURAN
            'pengukuran_grounding'          => 'nullable|numeric',
            'pengukuran_pencahayaan'        => 'nullable|numeric',
            'pengukuran_suhu'               => 'nullable|numeric',
            'pengukuran_kebisingan'         => 'nullable|numeric',

            // FOTO PENGUJIAN
            'foto_pengujian'                => 'nullable|array',
            'foto_pengujian.*'              => 'image|mimes:jpg,jpeg,png|max:10240',

            // DATA PENGUJIAN
            'pengujian_grounding'           => 'nullable|numeric',
            'pengujian_pencahayaan'         => 'nullable|numeric',
            'pengujian_suhu'                => 'nullable|numeric',
            'pengujian_kebisingan'          => 'nullable|numeric',

            // EMERGENCY STOP
            'emergency_stop'                => 'nullable|string|max:255',
            'emergency_stop_hasil'          => 'nullable|string|max:255',
            'ket_emergency_stop_tutup'      => 'nullable|string',

            // BLANK FIELD
            'blank'                         => 'nullable|string|max:255',
            'blank_hasil'                   => 'nullable|string|max:255',
            'ket_blank'                     => 'nullable|string',
            'blank2'                        => 'nullable|string|max:255',
            'blank2_hasil'                  => 'nullable|string|max:255',
            'ket_blank2'                    => 'nullable|string',
            'blank3'                        => 'nullable|string|max:255',
            'blank3_hasil'                  => 'nullable|string|max:255',
            'ket_blank3'                    => 'nullable|string',
            'catatan'                       => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum', 'foto_device', 'foto_pengukuran', 'foto_pengujian'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('listrik/instalasi_listrik', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpInstalasiListrik::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.listrik.instalasi_listrik.index')->with('success', 'Form KP Instalasi Listrik berhasil disimpan!');
    }

    public function show(FormKpInstalasiListrik $formKpInstalasiListrik)
    {
        // load relasi
        $formKpInstalasiListrik->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.listrik.instalasi_listrik.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Instalasi Listrik',
            'subtitle' => '',
            'formKpInstalasiListrik' => $formKpInstalasiListrik,
        ]);
    }

    public function edit(FormKpInstalasiListrik $formKpInstalasiListrik)
    {
        return view('form_kp.listrik.instalasi_listrik.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Instalasi Listrik',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpInstalasiListrik' => $formKpInstalasiListrik,
        ]);
    }

    public function update(Request $request, FormKpInstalasiListrik $formKpInstalasiListrik)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan'           => 'nullable|date',
            'pabrik_pembuat'                => 'nullable|string|max:255',

            // FOTO INFORMASI UMUM
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'nama_mesin'                    => 'nullable|string|max:255',
            'fungsi'                        => 'nullable|string|max:255',
            'lokasi'                        => 'nullable|string|max:255',

            // FOTO DEVICE
            'foto_device'                   => 'nullable|array',
            'foto_device.*'                 => 'image|mimes:jpg,jpeg,png|max:10240',

            // SAFETY DEVICE 1–10
            'safety_device1'                => 'nullable|string|max:255',
            'safety_device2'                => 'nullable|string|max:255',
            'safety_device3'                => 'nullable|string|max:255',
            'safety_device4'                => 'nullable|string|max:255',
            'safety_device5'                => 'nullable|string|max:255',
            'safety_device6'                => 'nullable|string|max:255',
            'safety_device7'                => 'nullable|string|max:255',
            'safety_device8'                => 'nullable|string|max:255',
            'safety_device9'                => 'nullable|string|max:255',
            'safety_device10'               => 'nullable|string|max:255',

            // KOMPONEN UTAMA 1–10
            'komponen_utama1'               => 'nullable|string|max:255',
            'komponen_utama2'               => 'nullable|string|max:255',
            'komponen_utama3'               => 'nullable|string|max:255',
            'komponen_utama4'               => 'nullable|string|max:255',
            'komponen_utama5'               => 'nullable|string|max:255',
            'komponen_utama6'               => 'nullable|string|max:255',
            'komponen_utama7'               => 'nullable|string|max:255',
            'komponen_utama8'               => 'nullable|string|max:255',
            'komponen_utama9'               => 'nullable|string|max:255',
            'komponen_utama10'              => 'nullable|string|max:255',

            // PENDUKUNG MESIN 1–10
            'pendukung_mesin1'              => 'nullable|string|max:255',
            'pendukung_mesin2'              => 'nullable|string|max:255',
            'pendukung_mesin3'              => 'nullable|string|max:255',
            'pendukung_mesin4'              => 'nullable|string|max:255',
            'pendukung_mesin5'              => 'nullable|string|max:255',
            'pendukung_mesin6'              => 'nullable|string|max:255',
            'pendukung_mesin7'              => 'nullable|string|max:255',
            'pendukung_mesin8'              => 'nullable|string|max:255',
            'pendukung_mesin9'              => 'nullable|string|max:255',
            'pendukung_mesin10'             => 'nullable|string|max:255',

            // FOTO PENGUKURAN
            'foto_pengukuran'               => 'nullable|array',
            'foto_pengukuran.*'             => 'image|mimes:jpg,jpeg,png|max:10240',

            // DATA PENGUKURAN
            'pengukuran_grounding'          => 'nullable|numeric',
            'pengukuran_pencahayaan'        => 'nullable|numeric',
            'pengukuran_suhu'               => 'nullable|numeric',
            'pengukuran_kebisingan'         => 'nullable|numeric',

            // FOTO PENGUJIAN
            'foto_pengujian'                => 'nullable|array',
            'foto_pengujian.*'              => 'image|mimes:jpg,jpeg,png|max:10240',

            // DATA PENGUJIAN
            'pengujian_grounding'           => 'nullable|numeric',
            'pengujian_pencahayaan'         => 'nullable|numeric',
            'pengujian_suhu'                => 'nullable|numeric',
            'pengujian_kebisingan'          => 'nullable|numeric',

            // EMERGENCY STOP
            'emergency_stop'                => 'nullable|string|max:255',
            'emergency_stop_hasil'          => 'nullable|string|max:255',
            'ket_emergency_stop_tutup'      => 'nullable|string',

            // BLANK FIELD
            'blank'                         => 'nullable|string|max:255',
            'blank_hasil'                   => 'nullable|string|max:255',
            'ket_blank'                     => 'nullable|string',
            'blank2'                        => 'nullable|string|max:255',
            'blank2_hasil'                  => 'nullable|string|max:255',
            'ket_blank2'                    => 'nullable|string',
            'blank3'                        => 'nullable|string|max:255',
            'blank3_hasil'                  => 'nullable|string|max:255',
            'ket_blank3'                    => 'nullable|string',
            'catatan'                       => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum', 'foto_device', 'foto_pengukuran', 'foto_pengujian'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpInstalasiListrik->$field) {
                    $oldFiles = json_decode($formKpInstalasiListrik->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('listrik/instalasi_listrik', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpInstalasiListrik->$field;
            }
        }

        $formKpInstalasiListrik->update($validated);

        return redirect()->route('form_kp.listrik.instalasi_listrik.index', $formKpInstalasiListrik->id)
            ->with('success', 'Form KP Instalasi Listrik berhasil diperbarui!');
    }
}
