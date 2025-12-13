<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpWheelLoader;
use Illuminate\Support\Facades\Storage;

class FormKpWheelLoaderController extends Controller
{
    public function index()
    {
        $wheelLoaders = FormKpWheelLoader::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 3)
                        ->where('sub_jenis_riksa_uji_id', 9);
                });
            })
            ->get();

        return view('form_kp.papa.wheel_loader.index', [
            'title' => 'Hasil Kartu Pemeriksaan Wheel Loader',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'wheelLoaders' => $wheelLoaders,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.papa.wheel_loader.create', [
            'title'         => 'Form Kartu Pemeriksaan Wheel Loader',
            'subtitle'         => 'Isi Form KP Wheel Loader',
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

            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            'panjang_keseluruhan'           => 'nullable|numeric',
            'tinggi_keseluruhan'            => 'nullable|numeric',
            'lebar_keseluruhan'             => 'nullable|numeric',
            'jarak_track_roda'              => 'nullable|numeric',
            'ukuran_lebar_roda'             => 'nullable|numeric',
            'kecepatan_maks_travelling'     => 'nullable|numeric',
            'kecepatan_mundur'              => 'nullable|numeric',

            'rem_macam'                     => 'nullable|string|max:50',
            'rem_type'                      => 'nullable|string|max:50',

            'radius_putaran_kiri'           => 'nullable|numeric',
            'radius_putaran_kanan'          => 'nullable|numeric',


            // Foto Mesin
            'foto_mesin'                    => 'nullable|array',
            'foto_mesin.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',

            'tipe_mesin'                    => 'nullable|string|max:50',
            'nomor_seri'                    => 'nullable|string|max:50',
            'jumlah_silinder'               => 'nullable|numeric',
            'daya_bersih'                   => 'nullable|numeric',
            'merek'                         => 'nullable|string|max:50',
            'tahun_pembuatan_mesin'         => 'nullable|string|max:50',
            'pabrik_pembuat_mesin'          => 'nullable|string|max:50',


            // Foto Pompa Hydraulik
            'foto_pompa_hydraulik'          => 'nullable|array',
            'foto_pompa_hydraulik.*'        => 'image|mimes:jpg,jpeg,png|max:10240',

            'pompa_hydraulik_type'          => 'nullable|string|max:50',
            'pompa_hydraulik_tekanan'       => 'nullable|string|max:50',


            // Foto Pengujian
            'foto_pengujian'                => 'nullable|array',
            'foto_pengujian.*'              => 'image|mimes:jpg,jpeg,png|max:10240',


            // Pengujian Travelling
            'fungsi_travelling_kecepatan'   => 'nullable|string|max:100',
            'travelling_gerakan_maju'       => 'nullable|string|max:100',
            'travelling_gerakan_mundur'     => 'nullable|string|max:100',
            'travelling_beban'              => 'nullable|string|max:100',
            'travelling_hasil'              => 'nullable|string|max:100',
            'travelling_keterangan'         => 'nullable|string|max:100',

            // Pengujian Belok
            'fungsi_belok_kecepatan'        => 'nullable|string|max:100',
            'belok_gerakan_maju'            => 'nullable|string|max:100',
            'belok_gerakan_mundur'          => 'nullable|string|max:100',
            'belok_beban'                   => 'nullable|string|max:100',
            'belok_hasil'                   => 'nullable|string|max:100',
            'belok_keterangan'              => 'nullable|string|max:100',

            // Pengujian Lengan
            'fungsi_lengan_kecepatan'       => 'nullable|string|max:100',
            'lengan_gerakan_maju'           => 'nullable|string|max:100',
            'lengan_gerakan_mundur'         => 'nullable|string|max:100',
            'lengan_beban'                  => 'nullable|string|max:100',
            'lengan_hasil'                  => 'nullable|string|max:100',
            'lengan_keterangan'             => 'nullable|string|max:100',

            // Pengujian Bucket
            'fungsi_bucket_kecepatan'       => 'nullable|string|max:100',
            'bucket_gerakan_maju'           => 'nullable|string|max:100',
            'bucket_gerakan_mundur'         => 'nullable|string|max:100',
            'bucket_beban'                  => 'nullable|string|max:100',
            'bucket_hasil'                  => 'nullable|string|max:100',
            'bucket_keterangan'             => 'nullable|string|max:100',

            // Pengujian Loading
            'fungsi_loading_kecepatan'      => 'nullable|string|max:100',
            'loading_gerakan_maju'          => 'nullable|string|max:100',
            'loading_gerakan_mundur'        => 'nullable|string|max:100',
            'loading_beban'                 => 'nullable|string|max:100',
            'loading_hasil'                 => 'nullable|string|max:100',
            'loading_keterangan'            => 'nullable|string|max:100',
            'catatan'                       => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum', 'foto_mesin', 'foto_pompa_hydraulik', 'foto_pengujian'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('papa/wheel_loader', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpWheelLoader::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.papa.wheel_loader.index')->with('success', 'Form KP Wheel Loader berhasil disimpan!');
    }

    public function show(FormKpWheelLoader $formKpWheelLoader)
    {
        // load relasi
        $formKpWheelLoader->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.papa.wheel_loader.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Wheel Loader',
            'subtitle' => '',
            'formKpWheelLoader' => $formKpWheelLoader,
        ]);
    }

    public function edit(FormKpWheelLoader $formKpWheelLoader)
    {
        return view('form_kp.papa.wheel_loader.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Wheel Loader',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpWheelLoader' => $formKpWheelLoader,
        ]);
    }

    public function update(Request $request, FormKpWheelLoader $formKpWheelLoader)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan'           => 'nullable|date',
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'image|mimes:jpg,jpeg,png|max:10240',

            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            'panjang_keseluruhan'           => 'nullable|numeric',
            'tinggi_keseluruhan'            => 'nullable|numeric',
            'lebar_keseluruhan'             => 'nullable|numeric',
            'jarak_track_roda'              => 'nullable|numeric',
            'ukuran_lebar_roda'             => 'nullable|numeric',
            'kecepatan_maks_travelling'     => 'nullable|numeric',
            'kecepatan_mundur'              => 'nullable|numeric',

            'rem_macam'                     => 'nullable|string|max:50',
            'rem_type'                      => 'nullable|string|max:50',

            'radius_putaran_kiri'           => 'nullable|numeric',
            'radius_putaran_kanan'          => 'nullable|numeric',


            // Foto Mesin
            'foto_mesin'                    => 'nullable|array',
            'foto_mesin.*'                  => 'image|mimes:jpg,jpeg,png|max:10240',

            'tipe_mesin'                    => 'nullable|string|max:50',
            'nomor_seri'                    => 'nullable|string|max:50',
            'jumlah_silinder'               => 'nullable|numeric',
            'daya_bersih'                   => 'nullable|numeric',
            'merek'                         => 'nullable|string|max:50',
            'tahun_pembuatan_mesin'         => 'nullable|string|max:50',
            'pabrik_pembuat_mesin'          => 'nullable|string|max:50',


            // Foto Pompa Hydraulik
            'foto_pompa_hydraulik'          => 'nullable|array',
            'foto_pompa_hydraulik.*'        => 'image|mimes:jpg,jpeg,png|max:10240',

            'pompa_hydraulik_type'          => 'nullable|string|max:50',
            'pompa_hydraulik_tekanan'       => 'nullable|string|max:50',


            // Foto Pengujian
            'foto_pengujian'                => 'nullable|array',
            'foto_pengujian.*'              => 'image|mimes:jpg,jpeg,png|max:10240',


            // Pengujian Travelling
            'fungsi_travelling_kecepatan'   => 'nullable|string|max:100',
            'travelling_gerakan_maju'       => 'nullable|string|max:100',
            'travelling_gerakan_mundur'     => 'nullable|string|max:100',
            'travelling_beban'              => 'nullable|string|max:100',
            'travelling_hasil'              => 'nullable|string|max:100',
            'travelling_keterangan'         => 'nullable|string|max:100',

            // Pengujian Belok
            'fungsi_belok_kecepatan'        => 'nullable|string|max:100',
            'belok_gerakan_maju'            => 'nullable|string|max:100',
            'belok_gerakan_mundur'          => 'nullable|string|max:100',
            'belok_beban'                   => 'nullable|string|max:100',
            'belok_hasil'                   => 'nullable|string|max:100',
            'belok_keterangan'              => 'nullable|string|max:100',

            // Pengujian Lengan
            'fungsi_lengan_kecepatan'       => 'nullable|string|max:100',
            'lengan_gerakan_maju'           => 'nullable|string|max:100',
            'lengan_gerakan_mundur'         => 'nullable|string|max:100',
            'lengan_beban'                  => 'nullable|string|max:100',
            'lengan_hasil'                  => 'nullable|string|max:100',
            'lengan_keterangan'             => 'nullable|string|max:100',

            // Pengujian Bucket
            'fungsi_bucket_kecepatan'       => 'nullable|string|max:100',
            'bucket_gerakan_maju'           => 'nullable|string|max:100',
            'bucket_gerakan_mundur'         => 'nullable|string|max:100',
            'bucket_beban'                  => 'nullable|string|max:100',
            'bucket_hasil'                  => 'nullable|string|max:100',
            'bucket_keterangan'             => 'nullable|string|max:100',

            // Pengujian Loading
            'fungsi_loading_kecepatan'      => 'nullable|string|max:100',
            'loading_gerakan_maju'          => 'nullable|string|max:100',
            'loading_gerakan_mundur'        => 'nullable|string|max:100',
            'loading_beban'                 => 'nullable|string|max:100',
            'loading_hasil'                 => 'nullable|string|max:100',
            'loading_keterangan'            => 'nullable|string|max:100',
            'catatan'                       => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum', 'foto_mesin', 'foto_pompa_hydraulik', 'foto_pengujian'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpWheelLoader->$field) {
                    $oldFiles = json_decode($formKpWheelLoader->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('papa/wheel_loader', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpWheelLoader->$field;
            }
        }

        $formKpWheelLoader->update($validated);

        return redirect()->route('form_kp.papa.wheel_loader.index', $formKpWheelLoader->id)
            ->with('success', 'Form KP Wheel Loader berhasil diperbarui!');
    }
}
