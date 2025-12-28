<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use App\Models\FormKpElevator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class FormKpElevatorController extends Controller
{
    public function index()
    {
        $elevators = FormKpElevator::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                    ->whereHas('tool', fn($q2) => $q2->where('jenis_riksa_uji_id', 5)
                        ->where('sub_jenis_riksa_uji_id', 17));
            })
            ->get();

        return view('form_kp.eskalator.elevator.index', [
            'title' => 'Form KP Elevator',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'elevators' => $elevators,
        ]);
    }

    public function search(Request $request)
    {
        $q = trim($request->q);

        $elevators = FormKpElevator::with([
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

        return response()->json($elevators);
    }

    public function create($jobOrderToolId)
    {
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')->findOrFail($jobOrderToolId);

        return view('form_kp.eskalator.elevator.create', [
            'title' => 'Form KP Elevator',
            'subtitle' => 'Isi Form KP Elevator',
            'jobOrderTool' => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        //  dd($request->all());
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);

        $validated = $request->validate(
            array_merge(
                [
                    'tanggal_pemeriksaan' => 'nullable|date_format:d-m-Y',

                    'pabrik_pembuat' => 'nullable|string|max:100',
                    'jenis_elevator' => 'nullable|string|max:100',
                    'lokasi_elevator' => 'nullable|string|max:100',

                    'tahun_pembuatan' => 'nullable|string|max:4',

                    'negara_tahun_pembuat' => 'nullable|string|max:100',

                    'jumlah_lantai_pemberhentian' => 'nullable|string|max:30',
                    'kecepatan_elevator' => 'nullable|string|max:30',
                ],

                // ✅ Foto multiple
                $this->generateFotoValidation([
                    'foto_informasi_umum',
                    'foto_mesin',
                    'foto_tali_penggantung',
                    'foto_teromol',
                    'foto_bangun_ruang_luncur',
                    'foto_komponen_kereta',
                    'foto_governor_rem',
                    'foto_bobot_imbang',
                    'foto_instalasi_listrik'
                ]),

                // ✅ Radio
                $this->generateRadioValidation([
                    'dudukan_mesin',
                    'rem_mekanik',
                    'rem_electric',
                    'konstruksi_kamar',
                    'ruang_bebas_kamar',
                    'penerangan_kamar_mesin',
                    'ventilasi_pendingin',
                    'pintu_kamar_mesin',
                    'posisi_panel',
                    'alat_pelindung',
                    'pelindung_lubang_talibaja',
                    'tangga_kamar_mesin',
                    'perbedaan_ketinggian',
                    'alat_pemadam_ringan',
                    'elevator_tanpa_kamar',

                    'kerangka',
                    'badan_kereta',
                    'tinggi_dinding',
                    'luas_lantai',
                    'perluasan_luas_kereta',
                    'pintu_kereta',
                    'ukuran',
                    'kunci_kait',
                    'celah_antar_pintu',
                    'sisi_luar_kereta',
                    'alarm_bell',
                    'sumber_tenaga_cadangan',
                    'intercom',
                    'ventilasi',
                    'penerangan_darurat',
                    'panel_operasi',
                    'penunjuk_posisi_sangkar',

                    'nama_pembuat',
                    'kapasitas_beban',
                    'rambu_dilarang_merokok',
                    'indikasi_beban_lebih',
                    'tombol_buka_tutup',
                    'tombol_lantai_pemberhentian',
                    'tombol_bell_alarm',
                    'intercom_dua_arah',

                    'kekuatan_atap_kereta',
                    'syarat_pintu_darurat',
                    'syarat_pintu_darurat_samping',
                    'pagar_pengaman',
                    'ukuran_pagar',
                    'ukuran_pagar_pengaman',
                    'penerangan_atap',
                    'tombol_operasi_manual',
                    'syarat_interior_kereta',

                    'penjepit_tali',
                    'saklar_governor',
                    'fungsi_kecepatan_rem',
                    'rem_pengaman',
                    'bentuk_rem_pengaman',
                    'rem_pengaman_berangsur',
                    'rem_pengaman_mendadak',
                    'syarat_rem_pengaman',
                    'kecepatan_kereta',
                    'saklar_pengaman',
                    'alat_pembatas',

                    'bahan_dipergunakan',
                    'pemasangan_sekat',
                    'konstruksi_rel',
                    'jenis_peredam',
                    'fungsi_peredam',
                    'saklar_pengaman_kereta',
                    'catu_daya_cadangan',
                    'pengoperasian_khusus',
                    'saklar_kebakaran',
                    'label_elevator_kebakaran',
                    'ketahanan_instalasi_api',
                    'dinding_luncur',
                    'ukuran_sangkar',
                    'ukuran_pintu_kereta',
                    'waktu_tempuh',
                    'lantai_evakuasi',
                    'standar_rangkaian',
                    'panel_listrik',
                    'catu_daya_ard',
                    'kabel_grounding',
                    'alarm_kebakaran',
                    'panel_operasi_disabilitas',
                    'tinggi_panel_operasi',
                    'waktu_bukaan_pintu',
                    'lebar_bukaan_pintu',
                    'informasi_operasi',
                    'label_operator_disabilitas',
                    'sensor_gempa_lebih_10lt_40m',
                    'fungsi_input_signal_sensor_gempa'
                ])
            )
        );

        // Konversi tanggal
        if (!empty($validated['tanggal_pemeriksaan'])) {
            $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
        }

        // Upload semua foto
        foreach (
            [
                'foto_informasi_umum',
                'foto_mesin',
                'foto_tali_penggantung',
                'foto_teromol',
                'foto_bangun_ruang_luncur',
                'foto_komponen_kereta',
                'foto_governor_rem',
                'foto_bobot_imbang',
                'foto_instalasi_listrik'
            ] as $field
        ) {
            $validated[$field] = $this->uploadFoto($request, $field);
        }

        // Relasi JobOrderTool
        $validated['job_order_tool_id'] = $jobOrderToolId;

        FormKpElevator::create($validated);

        // Update status alat
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.eskalator.elevator.index')->with('success', 'Form KP Elevator berhasil disimpan!');
    }

    public function show(FormKpElevator $formKpElevator)
    {
        $formKpElevator->load(['jobOrderTool.jobOrder', 'jobOrderTool.tool']);

        return view('form_kp.eskalator.elevator.show', [
            'title' => 'Detail Pemeriksaan Elevator',
            'subtitle' => '',
            'formKpElevator' => $formKpElevator,
        ]);
    }

    public function edit(FormKpElevator $formKpElevator)
    {
        return view('form_kp.eskalator.elevator.edit', [
            'title' => 'Edit Form KP Elevator',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpElevator' => $formKpElevator,
        ]);
    }

    public function update(Request $request, FormKpElevator $formKpElevator)
    {
        $validated = $request->validate(array_merge(
            [
                'tanggal_pemeriksaan' => 'nullable|date_format:d-m-Y',

                'pabrik_pembuat' => 'nullable|string|max:100',
                'jenis_elevator' => 'nullable|string|max:100',
                'lokasi_elevator' => 'nullable|string|max:100',

                'tahun_pembuatan' => 'nullable|string|max:4',

                'negara_tahun_pembuat' => 'nullable|string|max:100',

                'jumlah_lantai_pemberhentian' => 'nullable|string|max:30',
                'kecepatan_elevator' => 'nullable|string|max:30',
            ],
            $this->generateFotoValidation([
                'foto_informasi_umum',
                'foto_mesin',
                'foto_tali_penggantung',
                'foto_teromol',
                'foto_bangun_ruang_luncur',
                'foto_komponen_kereta',
                'foto_governor_rem',
                'foto_bobot_imbang',
                'foto_instalasi_listrik'
            ]),
            $this->generateRadioValidation([
                'dudukan_mesin',
                'rem_mekanik',
                'rem_electric',
                'konstruksi_kamar',
                'ruang_bebas_kamar',
                'penerangan_kamar_mesin',
                'ventilasi_pendingin',
                'pintu_kamar_mesin',
                'posisi_panel',
                'alat_pelindung',
                'pelindung_lubang_talibaja',
                'tangga_kamar_mesin',
                'perbedaan_ketinggian',
                'alat_pemadam_ringan',
                'elevator_tanpa_kamar',
                'kerangka',
                'badan_kereta',
                'tinggi_dinding',
                'luas_lantai',
                'perluasan_luas_kereta',
                'pintu_kereta',
                'ukuran',
                'kunci_kait',
                'celah_antar_pintu',
                'sisi_luar_kereta',
                'alarm_bell',
                'sumber_tenaga_cadangan',
                'intercom',
                'ventilasi',
                'penerangan_darurat',
                'panel_operasi',
                'penunjuk_posisi_sangkar',

                'nama_pembuat',
                'kapasitas_beban',
                'rambu_dilarang_merokok',
                'indikasi_beban_lebih',
                'tombol_buka_tutup',
                'tombol_lantai_pemberhentian',
                'tombol_bell_alarm',
                'intercom_dua_arah',

                'kekuatan_atap_kereta',
                'syarat_pintu_darurat',
                'syarat_pintu_darurat_samping',
                'pagar_pengaman',
                'ukuran_pagar',
                'ukuran_pagar_pengaman',
                'penerangan_atap',
                'tombol_operasi_manual',
                'syarat_interior_kereta',

                'penjepit_tali',
                'saklar_governor',
                'fungsi_kecepatan_rem',
                'rem_pengaman',
                'bentuk_rem_pengaman',
                'rem_pengaman_berangsur',
                'rem_pengaman_mendadak',
                'syarat_rem_pengaman',
                'kecepatan_kereta',
                'saklar_pengaman',
                'alat_pembatas',

                'bahan_dipergunakan',
                'pemasangan_sekat',
                'konstruksi_rel',
                'jenis_peredam',
                'fungsi_peredam',
                'saklar_pengaman_kereta',

                'catu_daya_cadangan',
                'pengoperasian_khusus',
                'saklar_kebakaran',
                'label_elevator_kebakaran',
                'ketahanan_instalasi_api',
                'dinding_luncur',
                'ukuran_sangkar',
                'ukuran_pintu_kereta',
                'waktu_tempuh',
                'lantai_evakuasi',
                'standar_rangkaian',
                'panel_listrik',
                'catu_daya_ard',
                'kabel_grounding',
                'alarm_kebakaran',
                'panel_operasi_disabilitas',
                'tinggi_panel_operasi',
                'waktu_bukaan_pintu',
                'lebar_bukaan_pintu',
                'informasi_operasi',
                'label_operator_disabilitas',
                'sensor_gempa_lebih_10lt_40m',
                'fungsi_input_signal_sensor_gempa'
            ])
            // update radio sesuai input
        ));

        if (!empty($validated['tanggal_pemeriksaan'])) {
            $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
        }

        // Upload ulang foto jika ada perubahan
        foreach (
            [
                'foto_informasi_umum',
                'foto_mesin',
                'foto_tali_penggantung',
                'foto_teromol',
                'foto_bangun_ruang_luncur',
                'foto_komponen_kereta',
                'foto_governor_rem',
                'foto_bobot_imbang',
                'foto_instalasi_listrik'
            ] as $field
        ) {
            if ($request->hasFile($field)) {
                if ($formKpElevator->$field) {
                    $oldFiles = is_string($formKpElevator->$field) ? json_decode($formKpElevator->$field, true) : $formKpElevator->$field;
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }
                $validated[$field] = $this->uploadFoto($request, $field);
            }
        }

        $formKpElevator->update($validated);

        return redirect()->route('form_kp.eskalator.elevator.index')->with('success', 'Form KP Elevator berhasil diperbarui!');
    }

    // Helper untuk validasi foto
    private function generateFotoValidation(array $fields): array
    {
        $rules = [];
        foreach ($fields as $field) {
            $rules[$field] = 'nullable|array';
            $rules["{$field}.*"] = 'image|mimes:jpg,jpeg,png|max:10240';
        }
        return $rules;
    }

    // Helper untuk validasi radio + keterangan
    private function generateRadioValidation(array $fields): array
    {
        $rules = [];
        foreach ($fields as $field) {
            $rules[$field] = 'nullable|string|in:Memenuhi,Tidak Memenuhi';
            $rules["{$field}_keterangan"] = 'nullable|string|max:100';
        }
        return $rules;
    }

    // Helper upload foto
    private function uploadFoto(Request $request, string $field): ?array
    {
        if (!$request->hasFile($field)) return null;

        $paths = [];
        foreach ($request->file($field) as $file) {
            $paths[] = $file->store("elevator/{$field}", 'public');
        }

        return $paths;
    }
}
