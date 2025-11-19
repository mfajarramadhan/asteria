<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpInstalasiFireAlarm;
use Illuminate\Support\Facades\Storage;

class FormKpInstalasiFireAlarmController extends Controller
{
    public function index()
    {
        $instalasiFireAlarms = FormKpInstalasiFireAlarm::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                    ->whereHas('tool', function ($q2) {
                        $q2->where('jenis_riksa_uji_id', 6)
                            ->where('sub_jenis_riksa_uji_id', 19);
                    });
            })
            ->get();

        return view('form_kp.ipk.instalasi_fire_alarm.index', [
            'title' => 'Hasil Kartu Pemeriksaan Instalasi Fire Alarm',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'instalasiFireAlarms' => $instalasiFireAlarms,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.ipk.instalasi_fire_alarm.create', [
            'title'         => 'Form Kartu Pemeriksaan Instalasi Fire Alarm',
            'subtitle'         => 'Isi Form KP Instalasi Fire Alarm',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        // Validasi input
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'pabrik_pembuat'     => 'nullable|string|max:255',
            'foto_shell'          => 'nullable|array',
            'foto_shell.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'ketidakbulatan'      => 'nullable|numeric',
            'ketebalan_shell'     => 'nullable|numeric',
            'diameter_shell'      => 'nullable|numeric',
            'panjang_shell'       => 'nullable|numeric',

            'foto_head'           => 'nullable|array',
            'foto_head.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_head'       => 'nullable|numeric',
            'ketebalan_head'      => 'nullable|numeric',

            'foto_pipa'           => 'nullable|array',
            'foto_pipa.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_pipa'       => 'nullable|numeric',
            'ketebalan_pipa'      => 'nullable|numeric',
            'panjang_pipa'        => 'nullable|numeric',

            'foto_instalasi'       => 'nullable|array',
            'foto_instalasi.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_instalasi'   => 'nullable|numeric',
            'ketebalan_instalasi'  => 'nullable|numeric',
            'panjang_instalasi'    => 'nullable|numeric',

            'safety_valv_cal'     => 'nullable|boolean',
            'tekanan_kerja'       => 'nullable|numeric',
            'set_safety_valv'     => 'nullable|numeric',

            'media_yang_diisikan' => 'nullable|string|max:255',
            'catatan'             => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d')
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_shell', 'foto_head', 'foto_pipa', 'foto_instalasi'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('ipk/instalasi_fire_alarm', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpInstalasiFireAlarm::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.ipk.instalasi_fire_alarm.index')->with('success', 'Form KP Instalasi Fire Alarm berhasil disimpan!');
    }

    public function show(FormKpInstalasiFireAlarm $formKpInstalasiFireAlarm)
    {
        // load relasi
        $formKpInstalasiFireAlarm->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.ipk.instalasi_fire_alarm.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Instalasi Fire Alarm',
            'subtitle' => '',
            'formKpInstalasiFireAlarm' => $formKpInstalasiFireAlarm,
        ]);
    }

    public function edit(FormKpInstalasiFireAlarm $formKpInstalasiFireAlarm)
    {
        return view('form_kp.ipk.instalasi_fire_alarm.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Instalasi Fire Alarm',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpInstalasiFireAlarm' => $formKpInstalasiFireAlarm,
        ]);
    }

    public function update(Request $request, FormKpInstalasiFireAlarm $formKpInstalasiFireAlarm)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'pabrik_pembuat'     => 'nullable|string|max:255',
            'foto_shell'          => 'nullable|array',
            'foto_shell.*'        => 'image|mimes:jpg,jpeg,png|max:10240',
            'ketidakbulatan'      => 'nullable|numeric',
            'ketebalan_shell'     => 'nullable|numeric',
            'diameter_shell'      => 'nullable|numeric',
            'panjang_shell'       => 'nullable|numeric',

            'foto_head'           => 'nullable|array',
            'foto_head.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_head'       => 'nullable|numeric',
            'ketebalan_head'      => 'nullable|numeric',

            'foto_pipa'           => 'nullable|array',
            'foto_pipa.*'         => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_pipa'       => 'nullable|numeric',
            'ketebalan_pipa'      => 'nullable|numeric',
            'panjang_pipa'        => 'nullable|numeric',

            'foto_instalasi'       => 'nullable|array',
            'foto_instalasi.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'diameter_instalasi'   => 'nullable|numeric',
            'ketebalan_instalasi'  => 'nullable|numeric',
            'panjang_instalasi'    => 'nullable|numeric',

            'safety_valv_cal'     => 'nullable|boolean',
            'tekanan_kerja'       => 'nullable|numeric',
            'set_safety_valv'     => 'nullable|numeric',

            'media_yang_diisikan' => 'nullable|string|max:255',
            'catatan'             => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_shell', 'foto_head', 'foto_pipa', 'foto_instalasi'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpInstalasiFireAlarm->$field) {
                    $oldFiles = json_decode($formKpInstalasiFireAlarm->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('ipk/instalasi_fire_alarm', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpInstalasiFireAlarm->$field;
            }
        }

        $formKpInstalasiFireAlarm->update($validated);

        return redirect()->route('form_kp.ipk.instalasi_fire_alarm.index', $formKpInstalasiFireAlarm->id)
            ->with('success', 'Form KP Instalasi Fire Alarm berhasil diperbarui!');
    }
}
