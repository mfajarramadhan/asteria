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
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);

        // ✅ Validasi lengkap semua field berdasarkan A–G
        $validated = $request->validate(array_merge(
            [
                'tanggal_pemeriksaan' => 'nullable|date',
                'nama_perusahaan' => 'nullable|string|max:255',
                'lokasi_lift' => 'nullable|string|max:255',
                'merk_lift' => 'nullable|string|max:255',
                'kapasitas_lift' => 'nullable|string|max:255',
            ],
            // Foto multiple
            $this->generateFotoValidation([
                'foto_komponen_kereta',
                'foto_panel_operasi',
                'foto_atap_kereta',
                'foto_governor_rem',
                'foto_bobot_imbang'
            ]),
            // Radio + keterangan
            $this->generateRadioValidation([
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
                'saklar_Pengaman',
                'alat_pembatas',

                'bahan_dipergunakan',
                'pemasangan_sekat',
                'konstruksi_rel',
                'jenis_peredam',
                'fungsi_peredam',
                'saklar_pengaman_kereta'
            ])
        ));

        // Konversi tanggal
        if (!empty($validated['tanggal_pemeriksaan'])) {
            $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
        }

        // Upload semua foto
        foreach (
            [
                'foto_komponen_kereta',
                'foto_panel_operasi',
                'foto_atap_kereta',
                'foto_governor_rem',
                'foto_bobot_imbang'
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
                'tanggal_pemeriksaan' => 'nullable|date',
                'nama_perusahaan' => 'nullable|string|max:255',
                'lokasi_lift' => 'nullable|string|max:255',
            ],
            $this->generateFotoValidation([
                'foto_komponen_kereta',
                'foto_panel_operasi',
                'foto_atap_kereta',
                'foto_governor_rem',
                'foto_bobot_imbang'
            ]),
            $this->generateRadioValidation(array_keys($request->all())) // update radio sesuai input
        ));

        if (!empty($validated['tanggal_pemeriksaan'])) {
            $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
        }

        // Upload ulang foto jika ada perubahan
        foreach (['foto_komponen_kereta', 'foto_panel_operasi', 'foto_atap_kereta', 'foto_governor_rem', 'foto_bobot_imbang'] as $field) {
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
            $rules["{$field}_keterangan"] = 'nullable|string|max:500';
        }
        return $rules;
    }

    // Helper upload foto
    private function uploadFoto(Request $request, string $field): ?string
    {
        if (!$request->hasFile($field)) return null;

        $paths = [];
        foreach ($request->file($field) as $file) {
            $paths[] = $file->store("elevator/{$field}", 'public');
        }
        return json_encode($paths);
    }
}
