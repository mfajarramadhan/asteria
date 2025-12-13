<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\FormKpPesawatTenagaProduksi;

class FormKpPesawatTenagaProduksiController extends Controller
{
    public function index()
    {
        $pesawatTenagaProduksis = FormKpPesawatTenagaProduksi::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 2)
                        ->where('sub_jenis_riksa_uji_id', 5);
                });
            })
            ->get();

        return view('form_kp.ptp.pesawat_tenaga_produksi.index', [
            'title' => 'Hasil Kartu Pemeriksaan Pesawat Tenaga Produksi',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'pesawatTenagaProduksis' => $pesawatTenagaProduksis,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.ptp.pesawat_tenaga_produksi.create', [
            'title'         => 'Form Kartu Pemeriksaan Pesawat Tenaga Produksi',
            'subtitle'         => 'Isi Form KP Pesawat Tenaga Produksi',
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
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'image|mimes:jpg,jpeg,png|max:10240',

            'pabrik_pembuat'                => 'nullable|string|max:255',
            'jenis'                         => 'nullable|string|max:255',
            'lokasi'                        => 'nullable|string|max:255',
            'tahun_pembuatan'               => 'nullable|string|max:255',
            'nama_mesin'                    => 'nullable|string|max:255',
            'fungsi'                        => 'nullable|string|max:255',

            'foto_device'                   => 'nullable|array',
            'foto_device.*'                 => 'image|mimes:jpg,jpeg,png|max:10240',
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

            'foto_pengukuran'               => 'nullable|array',
            'foto_pengukuran.*'             => 'image|mimes:jpg,jpeg,png|max:10240',
            'pengukuran_grounding'          => 'nullable|numeric',
            'pengukuran_pencahayaan'        => 'nullable|numeric',
            'pengukuran_suhu'               => 'nullable|numeric',
            'pengukuran_kebisingan'         => 'nullable|numeric',

            'foto_pengujian'                => 'nullable|array',
            'foto_pengujian.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'pengujian_grounding'           => 'nullable|numeric',
            'pengujian_pencahayaan'         => 'nullable|numeric',
            'pengujian_suhu'                => 'nullable|numeric',
            'pengujian_kebisingan'          => 'nullable|numeric',
            
            'emergency_stop'                => 'nullable|string|max:255',
            'emergency_stop_hasil'          => 'nullable|string|max:255',
            'ket_emergency_stop_tutup'      => 'nullable|string',
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
                    $paths[] = $file->store('ptp/pesawat_tenaga_produksi', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpPesawatTenagaProduksi::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.ptp.pesawat_tenaga_produksi.index')->with('success', 'Form KP Pesawat Tenaga Produksi berhasil disimpan!');
    }

    public function show(FormKpPesawatTenagaProduksi $formKpPesawatTenagaProduksi)
    {
        // load relasi
        $formKpPesawatTenagaProduksi->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.ptp.pesawat_tenaga_produksi.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Pesawat Tenaga Produksi',
            'subtitle' => '',
            'formKpPesawatTenagaProduksi' => $formKpPesawatTenagaProduksi,
        ]);
    }

    public function edit(FormKpPesawatTenagaProduksi $formKpPesawatTenagaProduksi)
    {
        return view('form_kp.ptp.pesawat_tenaga_produksi.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Pesawat Tenaga Produksi',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpPesawatTenagaProduksi' => $formKpPesawatTenagaProduksi,
        ]);
    }

    public function update(Request $request, FormKpPesawatTenagaProduksi $formKpPesawatTenagaProduksi)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan'           => 'nullable|date',
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'image|mimes:jpg,jpeg,png|max:10240',

            'pabrik_pembuat'                => 'nullable|string|max:255',
            'jenis'                         => 'nullable|string|max:255',
            'lokasi'                        => 'nullable|string|max:255',
            'tahun_pembuatan'               => 'nullable|string|max:255',
            'nama_mesin'                    => 'nullable|string|max:255',
            'fungsi'                        => 'nullable|string|max:255',

            'foto_device'                   => 'nullable|array',
            'foto_device.*'                 => 'image|mimes:jpg,jpeg,png|max:10240',
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

            'foto_pengukuran'               => 'nullable|array',
            'foto_pengukuran.*'             => 'image|mimes:jpg,jpeg,png|max:10240',
            'pengukuran_grounding'          => 'nullable|numeric',
            'pengukuran_pencahayaan'        => 'nullable|numeric',
            'pengukuran_suhu'               => 'nullable|numeric',
            'pengukuran_kebisingan'         => 'nullable|numeric',

            'foto_pengujian'                => 'nullable|array',
            'foto_pengujian.*'              => 'image|mimes:jpg,jpeg,png|max:10240',
            'pengujian_grounding'           => 'nullable|numeric',
            'pengujian_pencahayaan'         => 'nullable|numeric',
            'pengujian_suhu'                => 'nullable|numeric',
            'pengujian_kebisingan'          => 'nullable|numeric',
            
            'emergency_stop'                => 'nullable|string|max:255',
            'emergency_stop_hasil'          => 'nullable|string|max:255',
            'ket_emergency_stop_tutup'      => 'nullable|string',
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
                if ($formKpPesawatTenagaProduksi->$field) {
                    $oldFiles = json_decode($formKpPesawatTenagaProduksi->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('ptp/pesawat_tenaga_produksi', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpPesawatTenagaProduksi->$field;
            }
        }

        $formKpPesawatTenagaProduksi->update($validated);

        return redirect()->route('form_kp.ptp.pesawat_tenaga_produksi.index', $formKpPesawatTenagaProduksi->id)
            ->with('success', 'Form KP Pesawat Tenaga Produksi berhasil diperbarui!');
    }
}
