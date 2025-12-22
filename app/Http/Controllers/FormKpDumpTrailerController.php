<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpDumpTrailer;
use Illuminate\Support\Facades\Storage;

class FormKpDumpTrailerController extends Controller
{
    public function index()
    {
        $dumpTrailers = FormKpDumpTrailer::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 3)
                        ->where('sub_jenis_riksa_uji_id', 10);
                });
            })
            ->get();

        return view('form_kp.papa.dump_trailer.index', [
            'title' => 'Hasil Kartu Pemeriksaan Dump Trailer',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'dumpTrailers' => $dumpTrailers,
        ]);
    }

    public function search(Request $request)
    {
        $q = trim($request->q);

        $dumpTrailers = FormKpDumpTrailer::with([
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

        return response()->json($dumpTrailers);
    }

    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.papa.dump_trailer.create', [
            'title'         => 'Form Kartu Pemeriksaan Dump Trailer',
            'subtitle'         => 'Isi Form KP Dump Trailer',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        // dd($request->all());
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        // Validasi input
        $validated = $request->validate([
            'tanggal_pemeriksaan'       => 'nullable|date',
            'foto_informasi_umum'       => 'nullable|array',
            'foto_informasi_umum.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'            => 'nullable|string|max:100',
            'jenis'                     => 'nullable|string|max:100',
            'lokasi'                    => 'nullable|string|max:100',
            'tahun_pembuatan'           => 'nullable|string|max:100',

            'panjang_keseluruhan'       => 'nullable|numeric',
            'tinggi_keseluruhan'        => 'nullable|numeric',
            'ketinggian_kabin'          => 'nullable|numeric',
            'lebar_keseluruhan'         => 'nullable|numeric',
            'kecepatan_angkat'          => 'nullable|numeric',
            'kecepatan_turun'           => 'nullable|numeric',
            'kecepatan_travelling'      => 'nullable|numeric',
            'perlengkapan'              => 'nullable|string|max:100',
            'berat_kendaraan'           => 'nullable|numeric',

            // FOTO PENGGERAK UTAMA
            'foto_penggerak_utama'      => 'nullable|array',
            'foto_penggerak_utama.*'    => 'image|mimes:jpg,jpeg,png|max:10240',
            'merk_type'                 => 'nullable|string|max:100',
            'nomor_seri'                => 'nullable|string|max:100',
            'jumlah_silinder'           => 'nullable|string|max:50',
            'daya'                      => 'nullable|string|max:50',
            'tahun_pembuatan_mesin'     => 'nullable|string|max:50',
            'pabrik_pembuatan_mesin'    => 'nullable|string|max:50',

            // FOTO TEKANAN RODA
            'foto_tekanan_roda'         => 'nullable|array',
            'foto_tekanan_roda.*'       => 'image|mimes:jpg,jpeg,png|max:10240',
            'roda_penggerak'            => 'nullable|numeric',
            'roda_kemudi'               => 'nullable|numeric',

            // FOTO RODA PENGGERAK
            'foto_roda_penggerak'       => 'nullable|array',
            'foto_roda_penggerak.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'ukuran'                    => 'nullable|string|max:50',
            'tipe'                      => 'nullable|string|max:50',

            // FOTO RODA KEMUDI
            'foto_roda_kemudi'          => 'nullable|array',
            'foto_roda_kemudi.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'ukuran2'                   => 'nullable|string|max:50',
            'tipe2'                     => 'nullable|string|max:50',

            // FOTO POMPA HIDROLIK
            'foto_pompa_hidrolik'       => 'nullable|array',
            'foto_pompa_hidrolik.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'tipe_pompa'                => 'nullable|string|max:50',
            'tekanan_pompa'             => 'nullable|string|max:50',
            'relief_valve_pompa'        => 'nullable|string|max:50',

            // FOTO PENGUJIAN
            'foto_pengujian'            => 'nullable|array',
            'foto_pengujian.*'          => 'image|mimes:jpg,jpeg,png|max:10240',

            // PENGUJIAN 1
            'swl_tinggi_angkat1'        => 'nullable|numeric',
            'beban_uji_load1'           => 'nullable|numeric',
            'travelling_kecepatan1'     => 'nullable|numeric',
            'gerakan1'                  => 'nullable|numeric',
            'hasil1'                    => 'nullable|numeric',
            'keterangan1'               => 'nullable|string|max:100',

            // PENGUJIAN 2
            'swl_tinggi_angkat2'        => 'nullable|numeric',
            'beban_uji_load2'           => 'nullable|numeric',
            'travelling_kecepatan2'     => 'nullable|numeric',
            'gerakan2'                  => 'nullable|numeric',
            'hasil2'                    => 'nullable|numeric',
            'keterangan2'               => 'nullable|string|max:100',

            // PENGUJIAN 3
            'swl_tinggi_angkat3'        => 'nullable|numeric',
            'beban_uji_load3'           => 'nullable|numeric',
            'travelling_kecepatan3'     => 'nullable|numeric',
            'gerakan3'                  => 'nullable|numeric',
            'hasil3'                    => 'nullable|numeric',
            'keterangan3'               => 'nullable|string|max:100',
            'catatan'                   => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum', 'foto_penggerak_utama', 'foto_tekanan_roda', 'foto_roda_penggerak', 'foto_roda_kemudi', 'foto_pompa_hidrolik', 'foto_pengujian'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('papa/dump_trailer', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpDumpTrailer::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.papa.dump_trailer.index')->with('success', 'Form KP Dump Trailer berhasil disimpan!');
    }

    public function show(FormKpDumpTrailer $formKpDumpTrailer)
    {
        // load relasi
        $formKpDumpTrailer->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.papa.dump_trailer.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Dump Trailer',
            'subtitle' => '',
            'formKpDumpTrailer' => $formKpDumpTrailer,
        ]);
    }

    public function edit(FormKpDumpTrailer $formKpDumpTrailer)
    {
        return view('form_kp.papa.dump_trailer.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Dump Trailer',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpDumpTrailer' => $formKpDumpTrailer,
        ]);
    }

    public function update(Request $request, FormKpDumpTrailer $formKpDumpTrailer)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan'       => 'nullable|date',
            'foto_informasi_umum'       => 'nullable|array',
            'foto_informasi_umum.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'            => 'nullable|string|max:100',
            'jenis'                     => 'nullable|string|max:100',
            'lokasi'                    => 'nullable|string|max:100',
            'tahun_pembuatan'           => 'nullable|string|max:100',

            'panjang_keseluruhan'       => 'nullable|numeric',
            'tinggi_keseluruhan'        => 'nullable|numeric',
            'ketinggian_kabin'          => 'nullable|numeric',
            'lebar_keseluruhan'         => 'nullable|numeric',
            'kecepatan_angkat'          => 'nullable|numeric',
            'kecepatan_turun'           => 'nullable|numeric',
            'kecepatan_travelling'      => 'nullable|numeric',
            'perlengkapan'              => 'nullable|string|max:100',
            'berat_kendaraan'           => 'nullable|numeric',

            // FOTO PENGGERAK UTAMA
            'foto_penggerak_utama'      => 'nullable|array',
            'foto_penggerak_utama.*'    => 'image|mimes:jpg,jpeg,png|max:10240',
            'merk_type'                 => 'nullable|string|max:100',
            'nomor_seri'                => 'nullable|string|max:100',
            'jumlah_silinder'           => 'nullable|string|max:50',
            'daya'                      => 'nullable|string|max:50',
            'tahun_pembuatan_mesin'     => 'nullable|string|max:50',
            'pabrik_pembuatan_mesin'    => 'nullable|string|max:50',

            // FOTO TEKANAN RODA
            'foto_tekanan_roda'         => 'nullable|array',
            'foto_tekanan_roda.*'       => 'image|mimes:jpg,jpeg,png|max:10240',
            'roda_penggerak'            => 'nullable|numeric',
            'roda_kemudi'               => 'nullable|numeric',

            // FOTO RODA PENGGERAK
            'foto_roda_penggerak'       => 'nullable|array',
            'foto_roda_penggerak.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'ukuran'                    => 'nullable|string|max:50',
            'tipe'                      => 'nullable|string|max:50',

            // FOTO RODA KEMUDI
            'foto_roda_kemudi'          => 'nullable|array',
            'foto_roda_kemudi.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'ukuran2'                   => 'nullable|string|max:50',
            'tipe2'                     => 'nullable|string|max:50',

            // FOTO POMPA HIDROLIK
            'foto_pompa_hidrolik'       => 'nullable|array',
            'foto_pompa_hidrolik.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'tipe_pompa'                => 'nullable|string|max:50',
            'tekanan_pompa'             => 'nullable|string|max:50',
            'relief_valve_pompa'        => 'nullable|string|max:50',

            // FOTO PENGUJIAN
            'foto_pengujian'            => 'nullable|array',
            'foto_pengujian.*'          => 'image|mimes:jpg,jpeg,png|max:10240',

            // PENGUJIAN 1
            'swl_tinggi_angkat1'        => 'nullable|numeric',
            'beban_uji_load1'           => 'nullable|numeric',
            'travelling_kecepatan1'     => 'nullable|numeric',
            'gerakan1'                  => 'nullable|numeric',
            'hasil1'                    => 'nullable|numeric',
            'keterangan1'               => 'nullable|string|max:100',

            // PENGUJIAN 2
            'swl_tinggi_angkat2'        => 'nullable|numeric',
            'beban_uji_load2'           => 'nullable|numeric',
            'travelling_kecepatan2'     => 'nullable|numeric',
            'gerakan2'                  => 'nullable|numeric',
            'hasil2'                    => 'nullable|numeric',
            'keterangan2'               => 'nullable|string|max:100',

            // PENGUJIAN 3
            'swl_tinggi_angkat3'        => 'nullable|numeric',
            'beban_uji_load3'           => 'nullable|numeric',
            'travelling_kecepatan3'     => 'nullable|numeric',
            'gerakan3'                  => 'nullable|numeric',
            'hasil3'                    => 'nullable|numeric',
            'keterangan3'               => 'nullable|string|max:100',
            'catatan'                   => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum', 'foto_penggerak_utama', 'foto_tekanan_roda', 'foto_roda_penggerak', 'foto_roda_kemudi', 'foto_pompa_hidrolik', 'foto_pengujian'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpDumpTrailer->$field) {
                    $oldFiles = json_decode($formKpDumpTrailer->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('papa/dump_trailer', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpDumpTrailer->$field;
            }
        }

        $formKpDumpTrailer->update($validated);

        return redirect()->route('form_kp.papa.dump_trailer.index', $formKpDumpTrailer->id)
            ->with('success', 'Form KP Dump Trailer berhasil diperbarui!');
    }
}
