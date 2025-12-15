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
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            'daya_terpasang'                => 'nullable|numeric',
            'untuk_tenaga'                  => 'nullable|string|max:100',
            'untuk_instalaltir'             => 'nullable|string|max:100',
            'ampere_mcb'                    => 'nullable|numeric',
            'sumber_daya_listrik'           => 'nullable|string|max:100',
            'tahun_pemasangan'              => 'nullable|string|max:50',
            'lokasi'                        => 'nullable|string|max:100',

            // KONSTRUKSI
            'konstruksi_hasil'              => 'nullable|string|max:255',
            'konstruksi_keterangan'         => 'nullable|string|max:100',
            'konstruksi_foto'               => 'nullable|array',
            'konstruksi_foto.*'             => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // BAUT PENGIKAT
            'baut_pengikat_hasil'           => 'nullable|string|max:255',
            'baut_pengikat_keterangan'      => 'nullable|string|max:100',
            'baut_pengikat_foto'            => 'nullable|array',
            'baut_pengikat_foto.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KABEL
            'kabel_hasil'                   => 'nullable|string|max:255',
            'kabel_keterangan'              => 'nullable|string|max:100',
            'kabel_foto'                    => 'nullable|array',
            'kabel_foto.*'                  => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // PLAT TEMBAGA
            'plat_tembaga_hasil'            => 'nullable|string|max:255',
            'plat_tembaga_keterangan'       => 'nullable|string|max:100',
            'plat_tembaga_foto'             => 'nullable|array',
            'plat_tembaga_foto.*'           => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // BAUT PENGIKAT2
            'baut_pengikat_hasil2'           => 'nullable|string|max:255',
            'baut_pengikat_keterangan2'      => 'nullable|string|max:100',
            'baut_pengikat_foto2'            => 'nullable|array',
            'baut_pengikat_foto2.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // PEMBATAS
            'pembatas_hasil'                => 'nullable|string|max:255',
            'pembatas_keterangan'           => 'nullable|string|max:100',
            'pembatas_foto'                 => 'nullable|array',
            'pembatas_foto.*'               => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // TANDA PERINGATAN
            'tanda_peringatan_hasil'        => 'nullable|string|max:255',
            'tanda_peringatan_keterangan'   => 'nullable|string|max:100',
            'tanda_peringatan_foto'         => 'nullable|array',
            'tanda_peringatan_foto.*'       => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // APAR
            'apar_hasil'                    => 'nullable|string|max:255',
            'apar_keterangan'               => 'nullable|string|max:100',
            'apar_foto'                     => 'nullable|array',
            'apar_foto.*'                   => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // OIL GAUGE
            'oil_gauge_hasil'               => 'nullable|string|max:255',
            'oil_gauge_keterangan'          => 'nullable|string|max:100',
            'oil_gauge_foto'                => 'nullable|array',
            'oil_gauge_foto.*'              => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // THERMAL GAUGE
            'thermal_gauge_hasil'           => 'nullable|string|max:255',
            'thermal_gauge_keterangan'      => 'nullable|string|max:100',
            'thermal_gauge_foto'            => 'nullable|array',
            'thermal_gauge_foto.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // LAMPU INDIKATOR
            'lampu_indikator_hasil'         => 'nullable|string|max:255',
            'lampu_indikator_keterangan'    => 'nullable|string|max:100',
            'lampu_indikator_foto'          => 'nullable|array',
            'lampu_indikator_foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // ALAT UKUR
            'alat_ukur_hasil'               => 'nullable|string|max:255',
            'alat_ukur_keterangan'          => 'nullable|string|max:100',
            'alat_ukur_foto'                => 'nullable|array',
            'alat_ukur_foto.*'              => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // TANDA PINTU PANEL
            'tanda_pintu_panel_hasil'       => 'nullable|string|max:255',
            'tanda_pintu_panel_keterangan'  => 'nullable|string|max:100',
            'tanda_pintu_panel_foto'        => 'nullable|array',
            'tanda_pintu_panel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KUNCI PINTU PANEL
            'kunci_pintu_panel_hasil'       => 'nullable|string|max:255',
            'kunci_pintu_panel_keterangan'  => 'nullable|string|max:100',
            'kunci_pintu_panel_foto'        => 'nullable|array',
            'kunci_pintu_panel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // COVER PELINDUNG
            'cover_pelindung_hasil'         => 'nullable|string|max:255',
            'cover_pelindung_keterangan'    => 'nullable|string|max:100',
            'cover_pelindung_foto'          => 'nullable|array',
            'cover_pelindung_foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // GAMBAR SINGLE LINE
            'gambar_single_line_hasil'      => 'nullable|string|max:255',
            'gambar_single_line_keterangan' => 'nullable|string|max:100',
            'gambar_single_line_foto'       => 'nullable|array',
            'gambar_single_line_foto.*'     => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KABEL BONDING
            'kabel_bonding_hasil'          => 'nullable|string|max:255',
            'kabel_bonding_keterangan'     => 'nullable|string|max:100',
            'kabel_bonding_foto'           => 'nullable|array',
            'kabel_bonding_foto.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // LABEL
            'label_hasil'                  => 'nullable|string|max:255',
            'label_keterangan'             => 'nullable|string|max:100',
            'label_foto'                   => 'nullable|array',
            'label_foto.*'                 => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KODE WARNA KABEL
            'kode_warna_kabel_hasil'       => 'nullable|string|max:255',
            'kode_warna_kabel_keterangan'  => 'nullable|string|max:100',
            'kode_warna_kabel_foto'        => 'nullable|array',
            'kode_warna_kabel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KEBERSIHAN PANEL
            'kebersihan_panel_hasil'       => 'nullable|string|max:255',
            'kebersihan_panel_keterangan'  => 'nullable|string|max:100',
            'kebersihan_panel_foto'        => 'nullable|array',
            'kebersihan_panel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KERAPIAN INSTALASI
            'kerapian_instalasi_hasil'     => 'nullable|string|max:255',
            'kerapian_instalasi_keterangan'=> 'nullable|string|max:100',
            'kerapian_instalasi_foto'      => 'nullable|array',
            'kerapian_instalasi_foto.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // JARAK DEPAN
            'jarak_depan_hasil'            => 'nullable|string|max:255',
            'jarak_depan_keterangan'       => 'nullable|string|max:100',
            'jarak_depan_foto'             => 'nullable|array',
            'jarak_depan_foto.*'           => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // JARAK SAMPING
            'jarak_samping_hasil'          => 'nullable|string|max:255',
            'jarak_samping_keterangan'     => 'nullable|string|max:100',
            'jarak_samping_foto'           => 'nullable|array',
            'jarak_samping_foto.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // JARAK BELAKANG
            'jarak_belakang_hasil'         => 'nullable|string|max:255',
            'jarak_belakang_keterangan'    => 'nullable|string|max:100',
            'jarak_belakang_foto'          => 'nullable|array',
            'jarak_belakang_foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // BEBAS BUKA PANEL
            'bebas_buka_panel_hasil'       => 'nullable|string|max:255',
            'bebas_buka_panel_keterangan'  => 'nullable|string|max:100',
            'bebas_buka_panel_foto'        => 'nullable|array',
            'bebas_buka_panel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // PENCAHAYAAN
            'pencahayaan_hasil'            => 'nullable|string|max:255',
            'pencahayaan_keterangan'       => 'nullable|string|max:100',
            'pencahayaan_foto'             => 'nullable|array',
            'pencahayaan_foto.*'           => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // BARANG TIDAK PAKAI
            'barang_tidak_pakai_hasil'     => 'nullable|string|max:255',
            'barang_tidak_pakai_keterangan'=> 'nullable|string|max:100',
            'barang_tidak_pakai_foto'      => 'nullable|array',
            'barang_tidak_pakai_foto.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // VENTILASI
            'ventilasi_hasil'              => 'nullable|string|max:255',
            'ventilasi_keterangan'         => 'nullable|string|max:100',
            'ventilasi_foto'               => 'nullable|array',
            'ventilasi_foto.*'             => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // SALURAN UAP
            'saluran_uap_hasil'            => 'nullable|string|max:255',
            'saluran_uap_keterangan'       => 'nullable|string|max:100',
            'saluran_uap_foto'             => 'nullable|array',
            'saluran_uap_foto.*'           => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // DIMENSI
            'dimensi_foto'                 => 'nullable|array',
            'dimensi_foto.*'               => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'jarak_bagian_depan'           => 'nullable|numeric',
            'jarak_bagian_samping'         => 'nullable|numeric',
            'jarak_bagian_belakang_tr'     => 'nullable|numeric',
            'jarak_bagian_belakang_tm'     => 'nullable|numeric',
            'jarak_antar_panel'            => 'nullable|numeric',
            'lebar_pintu_masuk'            => 'nullable|numeric',
            'tinggi_panel'                 => 'nullable|numeric',

            'keterangan'                   => 'nullable|string',

            // PEMBUMIAN
            'pembumian_foto'               => 'nullable|array',
            'pembumian_foto.*'             => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'trafo1'                       => 'nullable|numeric',
            'trafo2'                       => 'nullable|numeric',
            'trafo3'                       => 'nullable|numeric',
            'panel'                        => 'nullable|numeric',
            'bonding_panel'                => 'nullable|numeric',

            'keterangan2'                  => 'nullable|string',

            // PENCAHAYAAN PANEL (2)
            'pencahayaan_foto2'            => 'nullable|array',
            'pencahayaan_foto2.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'area_depan_panel'             => 'nullable|numeric',
            'area_blikg_panel'             => 'nullable|numeric',
            'area_trafo'                   => 'nullable|numeric',

            'keterangan3'                  => 'nullable|string',

            // THERMOGRAPHY
            'thermography_foto'            => 'nullable|array',
            'thermography_foto.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'trafo1_thermal'               => 'nullable|numeric',
            'trafo2_thermal'               => 'nullable|numeric',
            'trafo3_thermal'               => 'nullable|numeric',
            'circuit_breaker_utama'        => 'nullable|numeric',
            'circuit_breaker_distribusi'   => 'nullable|numeric',
            'busbar'                       => 'nullable|numeric',

            'keterangan4'                   => 'nullable|string',
            'catatan'                      => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach ([
            'foto_informasi_umum',
            'konstruksi_foto',
            'baut_pengikat_foto',
            'baut_pengikat_foto2',
            'kabel_foto',
            'plat_tembaga_foto',
            'pembatas_foto',
            'tanda_peringatan_foto',
            'apar_foto',
            'oil_gauge_foto',
            'thermal_gauge_foto',
            'lampu_indikator_foto',
            'alat_ukur_foto',
            'tanda_pintu_panel_foto',
            'kunci_pintu_panel_foto',
            'cover_pelindung_foto',
            'gambar_single_line_foto',
            'kabel_bonding_foto',
            'label_foto',
            'kode_warna_kabel_foto',
            'kebersihan_panel_foto',
            'kerapian_instalasi_foto',
            'jarak_depan_foto',
            'jarak_samping_foto',
            'jarak_belakang_foto',
            'bebas_buka_panel_foto',
            'pencahayaan_foto',
            'barang_tidak_pakai_foto',
            'ventilasi_foto',
            'saluran_uap_foto',
            'dimensi_foto',
            'pembumian_foto',
            'pencahayaan_foto2',
            'thermography_foto',
        ]
        as $field) {
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
            'foto_informasi_umum'           => 'nullable|array',
            'foto_informasi_umum.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'                => 'nullable|string|max:100',
            'jenis'                         => 'nullable|string|max:100',
            'lokasi'                        => 'nullable|string|max:100',
            'tahun_pembuatan'               => 'nullable|string|max:100',

            'daya_terpasang'                => 'nullable|numeric',
            'untuk_tenaga'                  => 'nullable|string|max:100',
            'untuk_instalaltir'             => 'nullable|string|max:100',
            'ampere_mcb'                    => 'nullable|numeric',
            'sumber_daya_listrik'           => 'nullable|string|max:100',
            'tahun_pemasangan'              => 'nullable|string|max:50',
            'lokasi'                        => 'nullable|string|max:100',

            // KONSTRUKSI
            'konstruksi_hasil'              => 'nullable|string|max:255',
            'konstruksi_keterangan'         => 'nullable|string|max:100',
            'konstruksi_foto'               => 'nullable|array',
            'konstruksi_foto.*'             => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // BAUT PENGIKAT
            'baut_pengikat_hasil'           => 'nullable|string|max:255',
            'baut_pengikat_keterangan'      => 'nullable|string|max:100',
            'baut_pengikat_foto'            => 'nullable|array',
            'baut_pengikat_foto.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KABEL
            'kabel_hasil'                   => 'nullable|string|max:255',
            'kabel_keterangan'              => 'nullable|string|max:100',
            'kabel_foto'                    => 'nullable|array',
            'kabel_foto.*'                  => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // PLAT TEMBAGA
            'plat_tembaga_hasil'            => 'nullable|string|max:255',
            'plat_tembaga_keterangan'       => 'nullable|string|max:100',
            'plat_tembaga_foto'             => 'nullable|array',
            'plat_tembaga_foto.*'           => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // BAUT PENGIKAT2
            'baut_pengikat_hasil2'           => 'nullable|string|max:255',
            'baut_pengikat_keterangan2'      => 'nullable|string|max:100',
            'baut_pengikat_foto2'            => 'nullable|array',
            'baut_pengikat_foto2.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // PEMBATAS
            'pembatas_hasil'                => 'nullable|string|max:255',
            'pembatas_keterangan'           => 'nullable|string|max:100',
            'pembatas_foto'                 => 'nullable|array',
            'pembatas_foto.*'               => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // TANDA PERINGATAN
            'tanda_peringatan_hasil'        => 'nullable|string|max:255',
            'tanda_peringatan_keterangan'   => 'nullable|string|max:100',
            'tanda_peringatan_foto'         => 'nullable|array',
            'tanda_peringatan_foto.*'       => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // APAR
            'apar_hasil'                    => 'nullable|string|max:255',
            'apar_keterangan'               => 'nullable|string|max:100',
            'apar_foto'                     => 'nullable|array',
            'apar_foto.*'                   => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // OIL GAUGE
            'oil_gauge_hasil'               => 'nullable|string|max:255',
            'oil_gauge_keterangan'          => 'nullable|string|max:100',
            'oil_gauge_foto'                => 'nullable|array',
            'oil_gauge_foto.*'              => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // THERMAL GAUGE
            'thermal_gauge_hasil'           => 'nullable|string|max:255',
            'thermal_gauge_keterangan'      => 'nullable|string|max:100',
            'thermal_gauge_foto'            => 'nullable|array',
            'thermal_gauge_foto.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // LAMPU INDIKATOR
            'lampu_indikator_hasil'         => 'nullable|string|max:255',
            'lampu_indikator_keterangan'    => 'nullable|string|max:100',
            'lampu_indikator_foto'          => 'nullable|array',
            'lampu_indikator_foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // ALAT UKUR
            'alat_ukur_hasil'               => 'nullable|string|max:255',
            'alat_ukur_keterangan'          => 'nullable|string|max:100',
            'alat_ukur_foto'                => 'nullable|array',
            'alat_ukur_foto.*'              => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // TANDA PINTU PANEL
            'tanda_pintu_panel_hasil'       => 'nullable|string|max:255',
            'tanda_pintu_panel_keterangan'  => 'nullable|string|max:100',
            'tanda_pintu_panel_foto'        => 'nullable|array',
            'tanda_pintu_panel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KUNCI PINTU PANEL
            'kunci_pintu_panel_hasil'       => 'nullable|string|max:255',
            'kunci_pintu_panel_keterangan'  => 'nullable|string|max:100',
            'kunci_pintu_panel_foto'        => 'nullable|array',
            'kunci_pintu_panel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // COVER PELINDUNG
            'cover_pelindung_hasil'         => 'nullable|string|max:255',
            'cover_pelindung_keterangan'    => 'nullable|string|max:100',
            'cover_pelindung_foto'          => 'nullable|array',
            'cover_pelindung_foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // GAMBAR SINGLE LINE
            'gambar_single_line_hasil'      => 'nullable|string|max:255',
            'gambar_single_line_keterangan' => 'nullable|string|max:100',
            'gambar_single_line_foto'       => 'nullable|array',
            'gambar_single_line_foto.*'     => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KABEL BONDING
            'kabel_bonding_hasil'          => 'nullable|string|max:255',
            'kabel_bonding_keterangan'     => 'nullable|string|max:100',
            'kabel_bonding_foto'           => 'nullable|array',
            'kabel_bonding_foto.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // LABEL
            'label_hasil'                  => 'nullable|string|max:255',
            'label_keterangan'             => 'nullable|string|max:100',
            'label_foto'                   => 'nullable|array',
            'label_foto.*'                 => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KODE WARNA KABEL
            'kode_warna_kabel_hasil'       => 'nullable|string|max:255',
            'kode_warna_kabel_keterangan'  => 'nullable|string|max:100',
            'kode_warna_kabel_foto'        => 'nullable|array',
            'kode_warna_kabel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KEBERSIHAN PANEL
            'kebersihan_panel_hasil'       => 'nullable|string|max:255',
            'kebersihan_panel_keterangan'  => 'nullable|string|max:100',
            'kebersihan_panel_foto'        => 'nullable|array',
            'kebersihan_panel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // KERAPIAN INSTALASI
            'kerapian_instalasi_hasil'     => 'nullable|string|max:255',
            'kerapian_instalasi_keterangan'=> 'nullable|string|max:100',
            'kerapian_instalasi_foto'      => 'nullable|array',
            'kerapian_instalasi_foto.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // JARAK DEPAN
            'jarak_depan_hasil'            => 'nullable|string|max:255',
            'jarak_depan_keterangan'       => 'nullable|string|max:100',
            'jarak_depan_foto'             => 'nullable|array',
            'jarak_depan_foto.*'           => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // JARAK SAMPING
            'jarak_samping_hasil'          => 'nullable|string|max:255',
            'jarak_samping_keterangan'     => 'nullable|string|max:100',
            'jarak_samping_foto'           => 'nullable|array',
            'jarak_samping_foto.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // JARAK BELAKANG
            'jarak_belakang_hasil'         => 'nullable|string|max:255',
            'jarak_belakang_keterangan'    => 'nullable|string|max:100',
            'jarak_belakang_foto'          => 'nullable|array',
            'jarak_belakang_foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // BEBAS BUKA PANEL
            'bebas_buka_panel_hasil'       => 'nullable|string|max:255',
            'bebas_buka_panel_keterangan'  => 'nullable|string|max:100',
            'bebas_buka_panel_foto'        => 'nullable|array',
            'bebas_buka_panel_foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // PENCAHAYAAN
            'pencahayaan_hasil'            => 'nullable|string|max:255',
            'pencahayaan_keterangan'       => 'nullable|string|max:100',
            'pencahayaan_foto'             => 'nullable|array',
            'pencahayaan_foto.*'           => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // BARANG TIDAK PAKAI
            'barang_tidak_pakai_hasil'     => 'nullable|string|max:255',
            'barang_tidak_pakai_keterangan'=> 'nullable|string|max:100',
            'barang_tidak_pakai_foto'      => 'nullable|array',
            'barang_tidak_pakai_foto.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // VENTILASI
            'ventilasi_hasil'              => 'nullable|string|max:255',
            'ventilasi_keterangan'         => 'nullable|string|max:100',
            'ventilasi_foto'               => 'nullable|array',
            'ventilasi_foto.*'             => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // SALURAN UAP
            'saluran_uap_hasil'            => 'nullable|string|max:255',
            'saluran_uap_keterangan'       => 'nullable|string|max:100',
            'saluran_uap_foto'             => 'nullable|array',
            'saluran_uap_foto.*'           => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            // DIMENSI
            'dimensi_foto'                 => 'nullable|array',
            'dimensi_foto.*'               => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'jarak_bagian_depan'           => 'nullable|numeric',
            'jarak_bagian_samping'         => 'nullable|numeric',
            'jarak_bagian_belakang_tr'     => 'nullable|numeric',
            'jarak_bagian_belakang_tm'     => 'nullable|numeric',
            'jarak_antar_panel'            => 'nullable|numeric',
            'lebar_pintu_masuk'            => 'nullable|numeric',
            'tinggi_panel'                 => 'nullable|numeric',

            'keterangan'                   => 'nullable|string',

            // PEMBUMIAN
            'pembumian_foto'               => 'nullable|array',
            'pembumian_foto.*'             => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'trafo1'                       => 'nullable|numeric',
            'trafo2'                       => 'nullable|numeric',
            'trafo3'                       => 'nullable|numeric',
            'panel'                        => 'nullable|numeric',
            'bonding_panel'                => 'nullable|numeric',

            'keterangan2'                  => 'nullable|string',

            // PENCAHAYAAN PANEL (2)
            'pencahayaan_foto2'            => 'nullable|array',
            'pencahayaan_foto2.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'area_depan_panel'             => 'nullable|numeric',
            'area_blikg_panel'             => 'nullable|numeric',
            'area_trafo'                   => 'nullable|numeric',

            'keterangan3'                  => 'nullable|string',

            // THERMOGRAPHY
            'thermography_foto'            => 'nullable|array',
            'thermography_foto.*'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'trafo1_thermal'               => 'nullable|numeric',
            'trafo2_thermal'               => 'nullable|numeric',
            'trafo3_thermal'               => 'nullable|numeric',
            'circuit_breaker_utama'        => 'nullable|numeric',
            'circuit_breaker_distribusi'   => 'nullable|numeric',
            'busbar'                       => 'nullable|numeric',

            'keterangan4'                   => 'nullable|string',
            'catatan'                      => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach ([
            'foto_informasi_umum',
            'konstruksi_foto',
            'baut_pengikat_foto',
            'baut_pengikat_foto2',
            'kabel_foto',
            'plat_tembaga_foto',
            'pembatas_foto',
            'tanda_peringatan_foto',
            'apar_foto',
            'oil_gauge_foto',
            'thermal_gauge_foto',
            'lampu_indikator_foto',
            'alat_ukur_foto',
            'tanda_pintu_panel_foto',
            'kunci_pintu_panel_foto',
            'cover_pelindung_foto',
            'gambar_single_line_foto',
            'kabel_bonding_foto',
            'label_foto',
            'kode_warna_kabel_foto',
            'kebersihan_panel_foto',
            'kerapian_instalasi_foto',
            'jarak_depan_foto',
            'jarak_samping_foto',
            'jarak_belakang_foto',
            'bebas_buka_panel_foto',
            'pencahayaan_foto',
            'barang_tidak_pakai_foto',
            'ventilasi_foto',
            'saluran_uap_foto',
            'dimensi_foto',
            'pembumian_foto',
            'pencahayaan_foto2',
            'thermography_foto',
        ]
        as $field) {
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
