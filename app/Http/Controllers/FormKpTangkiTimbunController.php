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
            'subtitle' => 'Daftar alat selesai diperiksa',
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
        // dd($request->all());
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);

        // Validasi input
        $validated = $request->validate([
            'tanggal_pemeriksaan'                 => 'nullable|date',
            'foto_informasi_umum'                 => 'nullable|array',
            'foto_informasi_umum.*'               => 'image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'                      => 'nullable|string|max:100',
            'jenis'                               => 'nullable|string|max:100',
            'lokasi'                              => 'nullable|string|max:100',
            'tahun_pembuatan'                     => 'nullable|string|max:100',
            'tempat_pembuatan'                    => 'nullable|string|max:100',
            'tekanan'                             => 'nullable|string|max:100',
            'suhu'                                => 'nullable|string|max:100',
            'media_yang_diisikan'                 => 'nullable|string|max:100',

            'foto_visual'                         => 'nullable|array',
            'foto_visual.*'                       => 'image|mimes:jpg,jpeg,png|max:10240',
            'tanda_kebocoran'                     => 'nullable|string|max:100',
            'tanda_kebocoran_keterangan'          => 'nullable|string|max:100',
            'kondisi_tangki'                      => 'nullable|string|max:100',
            'kondisi_tangki_keterangan'           => 'nullable|string|max:100',
            'komponen_sambungan'                  => 'nullable|string|max:100',
            'komponen_sambungan_keterangan'       => 'nullable|string|max:100',
            'penopang_tangki'                     => 'nullable|string|max:100',
            'penopang_tangki_keterangan'          => 'nullable|string|max:100',
            'pondasi_tangki'                      => 'nullable|string|max:100',
            'pondasi_tangki_keterangan'           => 'nullable|string|max:100',

            'pengukur_ketinggian'                 => 'nullable|string|max:100',
            'pengukur_ketinggian_keterangan'      => 'nullable|string|max:100',
            'ventilasi_terhalang'                 => 'nullable|string|max:100',
            'ventilasi_terhalang_keterangan'      => 'nullable|string|max:100',
            'segel_katup'                         => 'nullable|string|max:100',
            'segel_katup_keterangan'              => 'nullable|string|max:100',

            'jalur_pemipaan'                      => 'nullable|string|max:100',
            'jalur_pemipaan_keterangan'           => 'nullable|string|max:100',
            'jalur_pipa'                          => 'nullable|string|max:100',
            'jalur_pipa_keterangan'               => 'nullable|string|max:100',
            'area_bongkar'                        => 'nullable|string|max:100',
            'area_bongkar_keterangan'             => 'nullable|string|max:100',
            'sambungan_flense'                    => 'nullable|string|max:100',
            'sambungan_flense_keterangan'         => 'nullable|string|max:100',

            'secondary_containtment_rusak'        => 'nullable|string|max:100',
            'secondary_containtment_keterangan'   => 'nullable|string|max:100',
            'katup_drainase'                      => 'nullable|string|max:100',
            'katup_drainase_keterangan'           => 'nullable|string|max:100',
            'pagar_gerbang'                       => 'nullable|string|max:100',
            'pagar_gerbang_keterangan'            => 'nullable|string|max:100',
            'kotak_peralatan'                     => 'nullable|string|max:100',
            'kotak_peralatan_keterangan'          => 'nullable|string|max:100',

            'foto_pengukuran'                     => 'nullable|array',
            'foto_pengukuran.*'                   => 'image|mimes:jpg,jpeg,png|max:10240',

            'grounding1_hasil'                    => 'nullable|string|max:100',
            'grounding2_hasil'                    => 'nullable|string|max:100',

            'foto_komponen'                       => 'nullable|array',
            'foto_komponen.*'                     => 'image|mimes:jpg,jpeg,png|max:10240',

            'shell1'                              => 'nullable|string|max:100',
            'shell2'                              => 'nullable|string|max:100',
            'shell3'                              => 'nullable|string|max:100',
            'shell4'                              => 'nullable|string|max:100',
            'shell5'                              => 'nullable|string|max:100',
            'shell6'                              => 'nullable|string|max:100',

            'tebal_pelat_atap1'                   => 'nullable|string|max:100',
            'tebal_pelat_atap2'                   => 'nullable|string|max:100',
            'tebal_pelat_bottom1'                 => 'nullable|string|max:100',
            'tebal_pelat_bottom2'                 => 'nullable|string|max:100',
            'tebal_pipa_channel'                  => 'nullable|string|max:100',
            'tebal_instalasi_pipa'                => 'nullable|string|max:100',

            'foto_tangki'                         => 'nullable|array',
            'foto_tangki.*'                       => 'image|mimes:jpg,jpeg,png|max:10240',

            'diameter_tangki'                     => 'nullable|numeric',
            'tinggi_tangki'                       => 'nullable|numeric',
            'secondary_containtment'              => 'nullable|numeric',
            'tinggi_pagar_atap'                   => 'nullable|numeric',
            'tinggi_panjang_pipa'                 => 'nullable|numeric',
            'tinggi_panjang_instalasi_pipa'       => 'nullable|numeric',

            'tinggi_panjang_shell1'               => 'nullable|string|max:100',
            'tinggi_panjang_shell2'               => 'nullable|string|max:100',
            'tinggi_panjang_shell3'               => 'nullable|string|max:100',
            'tinggi_panjang_shell4'               => 'nullable|string|max:100',
            'tinggi_panjang_shell5'               => 'nullable|string|max:100',
            'tinggi_panjang_shell6'               => 'nullable|string|max:100',

            'catatan'                             => 'nullable|string|max:100',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum', 'foto_visual', 'foto_pengukuran', 'foto_komponen', 'foto_tangki'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('pubt/tangki_timbun', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
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
            'tanggal_pemeriksaan'                 => 'nullable|date',
            'foto_informasi_umum'                 => 'nullable|array',
            'foto_informasi_umum.*'               => 'image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'                      => 'nullable|string|max:100',
            'jenis'                               => 'nullable|string|max:100',
            'lokasi'                              => 'nullable|string|max:100',
            'tahun_pembuatan'                     => 'nullable|string|max:100',
            'tempat_pembuatan'                    => 'nullable|string|max:100',
            'tekanan'                             => 'nullable|string|max:100',
            'suhu'                                => 'nullable|string|max:100',
            'media_yang_diisikan'                 => 'nullable|string|max:100',

            'foto_visual'                         => 'nullable|array',
            'foto_visual.*'                       => 'image|mimes:jpg,jpeg,png|max:10240',
            'tanda_kebocoran'                     => 'nullable|string|max:100',
            'tanda_kebocoran_keterangan'          => 'nullable|string|max:100',
            'kondisi_tangki'                      => 'nullable|string|max:100',
            'kondisi_tangki_keterangan'           => 'nullable|string|max:100',
            'komponen_sambungan'                  => 'nullable|string|max:100',
            'komponen_sambungan_keterangan'       => 'nullable|string|max:100',
            'penopang_tangki'                     => 'nullable|string|max:100',
            'penopang_tangki_keterangan'          => 'nullable|string|max:100',
            'pondasi_tangki'                      => 'nullable|string|max:100',
            'pondasi_tangki_keterangan'           => 'nullable|string|max:100',

            'pengukur_ketinggian'                 => 'nullable|string|max:100',
            'pengukur_ketinggian_keterangan'      => 'nullable|string|max:100',
            'ventilasi_terhalang'                 => 'nullable|string|max:100',
            'ventilasi_terhalang_keterangan'      => 'nullable|string|max:100',
            'segel_katup'                         => 'nullable|string|max:100',
            'segel_katup_keterangan'              => 'nullable|string|max:100',

            'jalur_pemipaan'                      => 'nullable|string|max:100',
            'jalur_pemipaan_keterangan'           => 'nullable|string|max:100',
            'jalur_pipa'                          => 'nullable|string|max:100',
            'jalur_pipa_keterangan'               => 'nullable|string|max:100',
            'area_bongkar'                        => 'nullable|string|max:100',
            'area_bongkar_keterangan'             => 'nullable|string|max:100',
            'sambungan_flense'                    => 'nullable|string|max:100',
            'sambungan_flense_keterangan'         => 'nullable|string|max:100',

            'secondary_containtment_rusak'        => 'nullable|string|max:100',
            'secondary_containtment_keterangan'   => 'nullable|string|max:100',
            'katup_drainase'                      => 'nullable|string|max:100',
            'katup_drainase_keterangan'           => 'nullable|string|max:100',
            'pagar_gerbang'                       => 'nullable|string|max:100',
            'pagar_gerbang_keterangan'            => 'nullable|string|max:100',
            'kotak_peralatan'                     => 'nullable|string|max:100',
            'kotak_peralatan_keterangan'          => 'nullable|string|max:100',

            'foto_pengukuran'                     => 'nullable|array',
            'foto_pengukuran.*'                   => 'image|mimes:jpg,jpeg,png|max:10240',

            'grounding1_hasil'                    => 'nullable|string|max:100',
            'grounding2_hasil'                    => 'nullable|string|max:100',

            'foto_komponen'                       => 'nullable|array',
            'foto_komponen.*'                     => 'image|mimes:jpg,jpeg,png|max:10240',

            'shell1'                              => 'nullable|string|max:100',
            'shell2'                              => 'nullable|string|max:100',
            'shell3'                              => 'nullable|string|max:100',
            'shell4'                              => 'nullable|string|max:100',
            'shell5'                              => 'nullable|string|max:100',
            'shell6'                              => 'nullable|string|max:100',

            'tebal_pelat_atap1'                   => 'nullable|string|max:100',
            'tebal_pelat_atap2'                   => 'nullable|string|max:100',
            'tebal_pelat_bottom1'                 => 'nullable|string|max:100',
            'tebal_pelat_bottom2'                 => 'nullable|string|max:100',
            'tebal_pipa_channel'                  => 'nullable|string|max:100',
            'tebal_instalasi_pipa'                => 'nullable|string|max:100',

            'foto_tangki'                         => 'nullable|array',
            'foto_tangki.*'                       => 'image|mimes:jpg,jpeg,png|max:10240',

            'diameter_tangki'                     => 'nullable|numeric',
            'tinggi_tangki'                       => 'nullable|numeric',
            'secondary_containtment'              => 'nullable|numeric',
            'tinggi_pagar_atap'                   => 'nullable|numeric',
            'tinggi_panjang_pipa'                 => 'nullable|numeric',
            'tinggi_panjang_instalasi_pipa'       => 'nullable|numeric',

            'tinggi_panjang_shell1'               => 'nullable|string|max:100',
            'tinggi_panjang_shell2'               => 'nullable|string|max:100',
            'tinggi_panjang_shell3'               => 'nullable|string|max:100',
            'tinggi_panjang_shell4'               => 'nullable|string|max:100',
            'tinggi_panjang_shell5'               => 'nullable|string|max:100',
            'tinggi_panjang_shell6'               => 'nullable|string|max:100',

            'catatan'                             => 'nullable|string|max:100',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum', 'foto_visual', 'foto_pengukuran', 'foto_komponen', 'foto_tangki'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpTangkiTimbun->$field) {
                    $oldFiles = json_decode($formKpTangkiTimbun->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('pubt/tangki_timbun', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpTangkiTimbun->$field;
            }
        }

        $formKpTangkiTimbun->update($validated);

        return redirect()->route('form_kp.pubt.tangki_timbun.index', $formKpTangkiTimbun->id)
            ->with('success', 'Form KP Tangki Timbun berhasil diperbarui!');
    }
}
