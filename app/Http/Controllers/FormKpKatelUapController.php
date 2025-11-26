<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use App\Models\FormKpKatelUap;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class FormKpKatelUapController extends Controller
{
    public function index()
    {
        $katelUaps = FormKpKatelUap::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 1)
                        ->where('sub_jenis_riksa_uji_id', 2);
                });
            })
            ->get();

        return view('form_kp.pubt.katel_uap.index', [
            'title' => 'Form KP Katel Uap',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'katelUaps' => $katelUaps,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.pubt.katel_uap.create', [
            'title'         => 'Form KP Katel Uap',
            'subtitle'         => 'Isi Form KP Katel Uap',
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
            'pabrik_pembuat'            => 'nullable|string|max:255',

            'foto_informasi_umum'       => 'nullable|array',
            'foto_informasi_umum.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'jenis_alat'                => 'nullable|string|max:255',
            'tempat'                    => 'nullable|string|max:255',
            'tahun_pembuatan'           => 'nullable|string|max:255',
            'tekanan_desain'            => 'nullable|numeric',
            'tekanan_kerja'             => 'nullable|numeric',
            'kapasitas_uap'             => 'nullable|string|max:255',
            'luas_pemanasan'            => 'nullable|numeric',
            'work_temperature'          => 'nullable|numeric',
            'bahan_bakar'               => 'nullable|string|max:255',
            'lokasi'                    => 'nullable|string|max:255',

            'foto_safety_valve'         => 'nullable|array',
            'foto_safety_valve.*'       => 'image|mimes:jpg,jpeg,png|max:10240',
            'safety_valve1_membuka'     => 'nullable|numeric',
            'safety_valve1_menutup'     => 'nullable|numeric',
            'safety_valve2_membuka'     => 'nullable|numeric',
            'safety_valve2_menutup'     => 'nullable|numeric',
            'catatan_safety_valve'      => 'nullable|string',

            'foto_pressure_switch'      => 'nullable|array',
            'foto_pressure_switch.*'    => 'image|mimes:jpg,jpeg,png|max:10240',
            'pressure_switch_on_set'    => 'nullable|numeric',
            'pressure_switch_on_hasil'  => 'nullable|numeric',
            'pressure_switch_off_set'   => 'nullable|numeric',
            'pressure_switch_off_hasil' => 'nullable|numeric',
            'catatan_pressure_switch'   => 'nullable|string',
            'catatan'                   => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach (['foto_informasi_umum', 'foto_safety_valve', 'foto_pressure_switch'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('pubt/katel_uap', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpKatelUap::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.pubt.katel_uap.index')->with('success', 'Form KP Katel Uap berhasil disimpan!');
    }

    public function show(FormKpKatelUap $formKpKatelUap)
    {
        // load relasi
        $formKpKatelUap->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.pubt.katel_uap.show', [
            'title' => 'Detail Pemeriksaan Katel Uap',
            'subtitle' => '',
            'formKpKatelUap' => $formKpKatelUap,
        ]);
    }

    public function edit(FormKpKatelUap $formKpKatelUap)
    {
        return view('form_kp.pubt.katel_uap.edit', [
            'title' => 'Edit Form KP Katel Uap',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpKatelUap' => $formKpKatelUap,
        ]);
    }

    public function update(Request $request, FormKpKatelUap $formKpKatelUap)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan'       => 'nullable|date',
            'pabrik_pembuat'           => 'nullable|string|max:255',

            'foto_informasi_umum'       => 'nullable|array',
            'foto_informasi_umum.*'     => 'image|mimes:jpg,jpeg,png|max:10240',
            'jenis_alat'                => 'nullable|string|max:255',
            // 'merk_model'                => 'nullable|string|max:255',
            'tempat'                    => 'nullable|string|max:255',
            'tahun_pembuatan'           => 'nullable|string|max:255',
            // 'no_seri_unit'              => 'nullable|string|max:255',
            'tekanan_desain'            => 'nullable|numeric',
            'tekanan_kerja'             => 'nullable|numeric',
            'kapasitas_uap'             => 'nullable|string|max:255',
            // 'kapasitas_uap'             => 'nullable|string|max:255',
            'luas_pemanasan'            => 'nullable|numeric',
            'work_temperature'          => 'nullable|numeric',
            'bahan_bakar'               => 'nullable|string|max:255',
            'lokasi'                    => 'nullable|string|max:255',

            'foto_safety_valve'         => 'nullable|array',
            'foto_safety_valve.*'       => 'image|mimes:jpg,jpeg,png|max:10240',
            'safety_valve1_membuka'     => 'nullable|numeric',
            'safety_valve1_menutup'     => 'nullable|numeric',
            'safety_valve2_membuka'     => 'nullable|numeric',
            'safety_valve2_menutup'     => 'nullable|numeric',
            'catatan_safety_valve'      => 'nullable|string',

            'foto_pressure_switch'      => 'nullable|array',
            'foto_pressure_switch.*'    => 'image|mimes:jpg,jpeg,png|max:10240',
            'pressure_switch_on_set'    => 'nullable|numeric',
            'pressure_switch_on_hasil'  => 'nullable|numeric',
            'pressure_switch_off_set'   => 'nullable|numeric',
            'pressure_switch_off_hasil' => 'nullable|numeric',
            'catatan_pressure_switch'   => 'nullable|string',
            'catatan'                   => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach (['foto_informasi_umum', 'foto_safety_valve', 'foto_pressure_switch'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpKatelUap->$field) {
                    $oldFiles = json_decode($formKpKatelUap->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('pubt/katel_uap', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpKatelUap->$field;
            }
        }

        $formKpKatelUap->update($validated);

        return redirect()->route('form_kp.pubt.katel_uap.index', $formKpKatelUap->id)
            ->with('success', 'Form KP Katel Uap berhasil diperbarui!');
    }
}
