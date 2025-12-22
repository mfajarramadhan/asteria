<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpInstalasiFireHydrant;
use Illuminate\Support\Facades\Storage;

class FormKpInstalasiFireHydrantController extends Controller
{
    public function index()
    {
        $instalasiFireHydrant = FormKpInstalasiFireHydrant::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                    ->whereHas('tool', function ($q2) {
                        $q2->where('jenis_riksa_uji_id', 6)
                            ->where('sub_jenis_riksa_uji_id', 18);
                    });
            })
            ->get();

        return view('form_kp.ipk.instalasi_fire_hydrant.index', [
            'title' => 'Hasil Kartu Pemeriksaan Instalasi Fire Hydrant',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'instalasiFireHydrant' => $instalasiFireHydrant,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.ipk.instalasi_fire_hydrant.create', [
            'title'         => 'Form Kartu Pemeriksaan Instalasi Fire Hydrant',
            'subtitle'         => 'Isi Form KP Instalasi Fire Hydrant',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable', // Could be date or time based on migration
            'foto_informasi_umum' => 'nullable|array',
            'foto_informasi_umum.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            // Informasi Pemeriksaan
            'nama_perusahaan' => 'nullable|string|max:150',
            'kapasitas' => 'nullable|string|max:100',
            'model_unit' => 'nullable|string|max:100',
            'nomor_seri' => 'nullable|string|max:100',
            'pabrik_pembuat' => 'nullable|string|max:100',
            'jenis' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:100',
            'tahun_pembuatan' => 'nullable|string|max:50',

            // Spesifikasi Fisik
            'luas_lahan' => 'nullable|numeric',
            'total_luas_bangunan' => 'nullable|numeric',
            'struktur_utama' => 'nullable|string|max:150',
            'struktur_lantai' => 'nullable|string|max:150',
            'dinding_luar' => 'nullable|string|max:150',
            'dinding_dalam' => 'nullable|string|max:150',
            'rangka_plafond' => 'nullable|string|max:150',
            'penutup_plafond' => 'nullable|string|max:150',
            'rangka_atap' => 'nullable|string|max:150',
            'penutup_atap' => 'nullable|string|max:150',
            'tinggi_bangunan' => 'nullable|numeric',
            'jumlah_lantai' => 'nullable|integer',
            'jumlah_luas_lantai' => 'nullable|numeric',

            // Instalasi & Sumber Air
            'tahun_pemasangan' => 'nullable|integer|digits:4',
            'instalatir' => 'nullable|string|max:150',
            'sumber_air_baku' => 'nullable|string|max:150',
            'kapasitas_ground_tank' => 'nullable|numeric',
            'siamese_connection' => 'nullable|string|max:150',
            'priming_tank' => 'nullable|string|max:150',

            // Bejana & Valve
            'bejana_liter' => 'nullable|numeric',
            'bejana_tk_kg' => 'nullable|numeric',
            'bejana_tk_uji' => 'nullable|numeric',
            'pressure_relief_valve' => 'nullable|numeric',
            'test_valve' => 'nullable|numeric',

            // Komponen Hydrant
            'jumlah_hydrant_gedung' => 'nullable|string|max:150',
            'jumlah_hydrant_halaman' => 'nullable|string|max:150',
            'jumlah_hydrant_pillar' => 'nullable|string|max:150',
            'jumlah_landing_valve' => 'nullable|integer',

            // Pompa
            'merk_model_pompa_jockey' => 'nullable|string|max:100',
            'merk_model_pompa_utama' => 'nullable|string|max:100',
            'merk_model_pompa_diesel' => 'nullable|string|max:100',
            'nomor_seri_pompa_jockey' => 'nullable|string|max:100',
            'nomor_seri_pompa_utama' => 'nullable|string|max:100',
            'nomor_seri_pompa_diesel' => 'nullable|string|max:100',
            'kapasitas_pompa_jockey' => 'nullable|string|max:100',
            'kapasitas_pompa_utama' => 'nullable|string|max:100',
            'kapasitas_pompa_diesel' => 'nullable|string|max:100',
            'daya_pompa_jockey' => 'nullable|string|max:100',
            'daya_pompa_utama' => 'nullable|string|max:100',
            'daya_pompa_diesel' => 'nullable|string|max:100',

            // Pipa & Tekanan
            'pipa_header_diameter' => 'nullable|string|max:100',
            'pipa_hisap_diameter' => 'nullable|string|max:100',
            'pipa_penyalur_utama_diameter' => 'nullable|string|max:100',
            'pipa_tegak_diameter' => 'nullable|string|max:100',
            'catatan_diameter_pipa' => 'nullable|string|max:255',
            'tekanan_titik1' => 'nullable|string|max:100',
            'tekanan_titik2' => 'nullable|string|max:100',
            'tekanan_titik3' => 'nullable|string|max:100',
            'keterangan_tekanan' => 'nullable|string|max:255',
            'catatan' => 'nullable|string|max:255',
        ]);

        // Handing tanggal_pemeriksaan. 
        // Note: The migration specifies TIME type. However, forms usually submit date.
        // We will try to format it as Y-m-d. If it fails due to column type, the user should be notified to fix migration.
        // Assuming we want date here.
        if ($validated['tanggal_pemeriksaan']) {
             try {
                $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
             } catch (\Exception $e) {
                 // Ignore if format fails, keep original (maybe it's already Y-m-d or Time)
             }
        }

        // Upload Foto
        if ($request->hasFile('foto_informasi_umum')) {
            $paths = [];
            foreach ($request->file('foto_informasi_umum') as $file) {
                $paths[] = $file->store('ipk/instalasi_fire_hydrant/foto_umum', 'public');
            }
            $validated['foto_informasi_umum'] = json_encode($paths);
        } else {
            $validated['foto_informasi_umum'] = null;
        }

        $validated['job_order_tool_id'] = $jobOrderToolId;
        $validated['job_order_id'] = $jobOrderTool->job_order_id;

        FormKpInstalasiFireHydrant::create($validated);

        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.ipk.instalasi_fire_hydrant.index')->with('success', 'Form KP Instalasi Fire Hydrant berhasil disimpan!');
    }

    public function show(FormKpInstalasiFireHydrant $formKpInstalasiFireHydrant)
    {
        $formKpInstalasiFireHydrant->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.ipk.instalasi_fire_hydrant.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Instalasi Fire Hydrant',
            'subtitle' => '',
            'formKpInstalasiFireHydrant' => $formKpInstalasiFireHydrant,
        ]);
    }

    public function edit(FormKpInstalasiFireHydrant $formKpInstalasiFireHydrant)
    {
        return view('form_kp.ipk.instalasi_fire_hydrant.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Instalasi Fire Hydrant',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpInstalasiFireHydrant' => $formKpInstalasiFireHydrant,
        ]);
    }

    public function update(Request $request, FormKpInstalasiFireHydrant $formKpInstalasiFireHydrant)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable',
            'foto_informasi_umum' => 'nullable|array',
            'foto_informasi_umum.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            // Informasi Pemeriksaan
            'nama_perusahaan' => 'nullable|string|max:150',
            'kapasitas' => 'nullable|string|max:100',
            'model_unit' => 'nullable|string|max:100',
            'nomor_seri' => 'nullable|string|max:100',
            'pabrik_pembuat' => 'nullable|string|max:100',
            'jenis' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:100',
            'tahun_pembuatan' => 'nullable|string|max:50',

            // Spesifikasi Fisik
            'luas_lahan' => 'nullable|numeric',
            'total_luas_bangunan' => 'nullable|numeric',
            'struktur_utama' => 'nullable|string|max:150',
            'struktur_lantai' => 'nullable|string|max:150',
            'dinding_luar' => 'nullable|string|max:150',
            'dinding_dalam' => 'nullable|string|max:150',
            'rangka_plafond' => 'nullable|string|max:150',
            'penutup_plafond' => 'nullable|string|max:150',
            'rangka_atap' => 'nullable|string|max:150',
            'penutup_atap' => 'nullable|string|max:150',
            'tinggi_bangunan' => 'nullable|numeric',
            'jumlah_lantai' => 'nullable|integer',
            'jumlah_luas_lantai' => 'nullable|numeric',

            // Instalasi & Sumber Air
            'tahun_pemasangan' => 'nullable|integer|digits:4',
            'instalatir' => 'nullable|string|max:150',
            'sumber_air_baku' => 'nullable|string|max:150',
            'kapasitas_ground_tank' => 'nullable|numeric',
            'siamese_connection' => 'nullable|string|max:150',
            'priming_tank' => 'nullable|string|max:150',

            // Bejana & Valve
            'bejana_liter' => 'nullable|numeric',
            'bejana_tk_kg' => 'nullable|numeric',
            'bejana_tk_uji' => 'nullable|numeric',
            'pressure_relief_valve' => 'nullable|numeric',
            'test_valve' => 'nullable|numeric',

            // Komponen Hydrant
            'jumlah_hydrant_gedung' => 'nullable|string|max:150',
            'jumlah_hydrant_halaman' => 'nullable|string|max:150',
            'jumlah_hydrant_pillar' => 'nullable|string|max:150',
            'jumlah_landing_valve' => 'nullable|integer',

            // Pompa
            'merk_model_pompa_jockey' => 'nullable|string|max:100',
            'merk_model_pompa_utama' => 'nullable|string|max:100',
            'merk_model_pompa_diesel' => 'nullable|string|max:100',
            'nomor_seri_pompa_jockey' => 'nullable|string|max:100',
            'nomor_seri_pompa_utama' => 'nullable|string|max:100',
            'nomor_seri_pompa_diesel' => 'nullable|string|max:100',
            'kapasitas_pompa_jockey' => 'nullable|string|max:100',
            'kapasitas_pompa_utama' => 'nullable|string|max:100',
            'kapasitas_pompa_diesel' => 'nullable|string|max:100',
            'daya_pompa_jockey' => 'nullable|string|max:100',
            'daya_pompa_utama' => 'nullable|string|max:100',
            'daya_pompa_diesel' => 'nullable|string|max:100',

            // Pipa & Tekanan
            'pipa_header_diameter' => 'nullable|string|max:100',
            'pipa_hisap_diameter' => 'nullable|string|max:100',
            'pipa_penyalur_utama_diameter' => 'nullable|string|max:100',
            'pipa_tegak_diameter' => 'nullable|string|max:100',
            'catatan_diameter_pipa' => 'nullable|string|max:255',
            'tekanan_titik1' => 'nullable|string|max:100',
            'tekanan_titik2' => 'nullable|string|max:100',
            'tekanan_titik3' => 'nullable|string|max:100',
            'keterangan_tekanan' => 'nullable|string|max:255',
            'catatan' => 'nullable|string|max:255',
        ]);

        if ($validated['tanggal_pemeriksaan']) {
             try {
                $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');
             } catch (\Exception $e) {}
        }

        if ($request->hasFile('foto_informasi_umum')) {
            if ($formKpInstalasiFireHydrant->foto_informasi_umum) {
                $oldFiles = json_decode($formKpInstalasiFireHydrant->foto_informasi_umum, true) ?? [];
                foreach ($oldFiles as $oldFile) {
                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }
            }
            $paths = [];
            foreach ($request->file('foto_informasi_umum') as $file) {
                $paths[] = $file->store('ipk/instalasi_fire_hydrant/foto_umum', 'public');
            }
            $validated['foto_informasi_umum'] = json_encode($paths);
        } else {
             unset($validated['foto_informasi_umum']);
        }

        $formKpInstalasiFireHydrant->update($validated);

        return redirect()->route('form_kp.ipk.instalasi_fire_hydrant.index', $formKpInstalasiFireHydrant->id)
            ->with('success', 'Form KP Instalasi Fire Hydrant berhasil diperbarui!');
    }
}
