<?php
namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpBejanaTekan;
use Illuminate\Support\Facades\Storage;

class FormKpBejanaTekanController extends Controller
{
    public function index()
    {
        $bejanaTekans = FormKpBejanaTekan::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 1)
                        ->where('sub_jenis_riksa_uji_id', 1);
                });
            })
            ->get();

        return view('form_kp.pubt.bejana_tekan.index', [
            'title' => 'Hasil Kartu Pemeriksaan Bejana Tekan',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'bejanaTekans' => $bejanaTekans,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.pubt.bejana_tekan.create', [
            'title'         => 'Form Kartu Pemeriksaan Bejana Tekan',
            'subtitle'         => 'Isi Form KP Bejana Tekan',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        // Validasi input
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'foto_informasi_umum'    => 'nullable|array', 
            'foto_informasi_umum.*'  => 'image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'      => 'nullable|string|max:255',
            'jenis_bejana'        => 'nullable|string|max:255',
            'lokasi'              => 'nullable|string|max:255',
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
        foreach (['foto_informasi_umum', 'foto_shell', 'foto_head', 'foto_pipa', 'foto_instalasi'] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('pubt/bejana_tekan', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpBejanaTekan::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.pubt.bejana_tekan.index')->with('success', 'Form KP Bejana Tekan berhasil disimpan!');
    }

    public function show(FormKpBejanaTekan $formKpBejanaTekan)
    {
        // load relasi
        $formKpBejanaTekan->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.pubt.bejana_tekan.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Bejana Tekan',
            'subtitle' => '',
            'formKpBejanaTekan' => $formKpBejanaTekan,
        ]);
    }

    public function edit(FormKpBejanaTekan $formKpBejanaTekan)
    {
        return view('form_kp.pubt.bejana_tekan.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Bejana Tekan',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpBejanaTekan' => $formKpBejanaTekan,
        ]);
    }

    public function update(Request $request, FormKpBejanaTekan $formKpBejanaTekan)
    {
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'foto_informasi_umum'    => 'nullable|array', 
            'foto_informasi_umum.*'  => 'image|mimes:jpg,jpeg,png|max:10240',
            'pabrik_pembuat'     => 'nullable|string|max:255',
            'jenis_bejana'        => 'nullable|string|max:255',
            'lokasi'              => 'nullable|string|max:255',
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
        foreach (['foto_informasi_umum', 'foto_shell', 'foto_head', 'foto_pipa', 'foto_instalasi'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpBejanaTekan->$field) {
                    $oldFiles = json_decode($formKpBejanaTekan->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('pubt/bejana_tekan', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpBejanaTekan->$field;
            }
        }

        $formKpBejanaTekan->update($validated);

        return redirect()->route('form_kp.pubt.bejana_tekan.index', $formKpBejanaTekan->id)
            ->with('success', 'Form KP Bejana Tekan berhasil diperbarui!');
    }
}
