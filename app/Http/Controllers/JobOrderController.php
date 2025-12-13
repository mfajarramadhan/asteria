<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\JobOrderTool;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class JobOrderController extends Controller
{
    public function index()
    {
        $jobOrders = JobOrder::with('tools')->latest()->paginate(10);
        return view('job_orders.index', [
            'jobOrders' => $jobOrders,
            'title' => 'Job Order', 
            'subtitle' => 'Job Order PT. Asteria Riksa Indonesia'
        ]);
    }
    
    public function create()
    {
        $tools = Tool::all(); 
        $petugas = User::role('Tim Riksa Uji')->get(); // ambil user role petugas

        return view('job_orders.create', [
            'tools' => $tools,
            'petugas' => $petugas,
            'title' => 'Job Order',
            'subtitle' => 'Buat Job Order PT. Asteria Riksa Indonesia'
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
        'nama_perusahaan'                   => 'required|string|max:255',
        'alamat_perusahaan'                 => 'required|string|max:255',
        'pic_order'                         => 'required|string|max:255',
        'email'                             => 'nullable|email|max:255',
        'contact_person'                    => 'nullable|string|max:255',
        'no_penawaran'                      => 'nullable|string|max:255',
        'no_purcash_order'                  => 'nullable|string|max:255|unique:job_orders,no_purcash_order',

        'tanggal_pemeriksaan1'              => 'nullable|date',
        'tanggal_pemeriksaan2'              => 'nullable|date',
        'tanggal_pemeriksaan3'              => 'nullable|date',
        'tanggal_pemeriksaan4'              => 'nullable|date',
        'tanggal_pemeriksaan5'              => 'nullable|date',

        'jumlah_hari_pemeriksaan'           => 'required|integer|min:1',
        'tanggal_selesai'                   => 'nullable|date',
        'jam_bertemu'                       => 'nullable|date_format:H:i',
        'jam_selesai'                       => 'nullable|date_format:H:i',
        'pic_ditemui'                       => 'nullable|string|max:255',
        'contact_person2'                   => 'nullable|string|max:255',
        'tanggal_dibuat'                    => 'required|date',
        'nomor_jo'                          => 'required|string|max:50|unique:job_orders,nomor_jo',
        'catatan'                           => 'nullable|string|max:65535',    

        'tools'                             => 'required|array',
        'tools.*.tool_id'                   => 'required|exists:tools,id',
        'tools.*.qty'                       => 'required|integer|min:1',
        'tools.*.status'                    => 'required|string|in:pertama,resertifikasi',
        'tools.*.kapasitas'                 => 'nullable|string|max:255',
        'tools.*.model'                     => 'nullable|string|max:255',
        'tools.*.no_seri'                   => 'nullable|string|max:255',

        'responsibles'                      => 'nullable|array',
        'responsibles.*'                    => 'exists:users,id',
        'kelengkapan_manual_book'           => 'nullable|boolean',
        'qty_manual_book'                   => 'nullable|integer|min:1',
        'kelengkapan_layout'                => 'nullable|boolean',
        'qty_layout'                        => 'nullable|integer|min:1',
        'kelengkapan_maintenance_report'    => 'nullable|boolean',
        'qty_maintenance_report'            => 'nullable|integer|min:1',
        'kelengkapan_surat_permohonan'      => 'nullable|boolean',
        'qty_surat_permohonan'              => 'nullable|integer|min:1',    
        
    ]);

    // Cek validasi tanggal_dibuat & tanggal_pemeriksaan & tanggal_selesai
    $validator->after(function ($validator) use ($request) {

        // helper: coba parse dengan beberapa format yang diharapkan, fallback ke parse() aman
        $toCarbonSafe = function ($value) {
            if (!$value) return null;

            // Format utama yang digunakan di datepicker kamu: dd-mm-yyyy
            $preferredFormats = ['d-m-Y', 'Y-m-d', 'd/m/Y', 'Y/m/d'];

            foreach ($preferredFormats as $fmt) {
                $dt = \Carbon\Carbon::createFromFormat($fmt, $value);
                // createFromFormat akan menghasilkan Carbon meskipun parsing tidak sempurna,
                // jadi pastikan format hasil sama dengan input untuk validasi ketat
                if ($dt && $dt->format($fmt) === $value) {
                    return $dt->startOfDay();
                }
            }

            // fallback: coba parse generik (safe wrapped)
            try {
                return \Carbon\Carbon::parse($value)->startOfDay();
            } catch (\Throwable $e) {
                return null;
            }
        };

        $tanggalDibuat = $toCarbonSafe($request->tanggal_dibuat);

        // Kalau tanggal dibuat tidak ter-parse, tambahkan error dan stop
        if ($request->filled('tanggal_dibuat') && !$tanggalDibuat) {
            $validator->errors()->add('tanggal_dibuat', 'Format tanggal dibuat tidak valid (harus dd-mm-yyyy).');
            return;
        }

        // validasi setiap tanggal pemeriksaan terhadap tanggal dibuat
        if ($tanggalDibuat) {
            foreach (range(1, 5) as $i) {
                $field = "tanggal_pemeriksaan{$i}";
                if ($request->filled($field)) {
                    $tanggalPemeriksaan = $toCarbonSafe($request->$field);

                    // jika input pemeriksaan tidak bisa di-parse, laporkan error spesifik
                    if (!$tanggalPemeriksaan) {
                        $validator->errors()->add($field, "Format {$field} tidak valid (harus dd-mm-yyyy).");
                        // lanjut ke pemeriksaan berikutnya atau break? saya break agar user tahu satu-satu
                        break;
                    }

                    // cek: tanggal dibuat harus >= tanggal pemeriksaan
                    if ($tanggalDibuat->gt($tanggalPemeriksaan)) {
                        $validator->errors()->add(
                            'tanggal_dibuat',
                            "Tanggal JO dibuat harus sama atau lebih dari tanggal pemeriksaan!"
                        );
                        // stop loop karena sudah gagal
                        break;
                    }

                    // cek kebalikan (opsional, tetapi konsisten)
                    if ($tanggalPemeriksaan->lt($tanggalDibuat)) {
                        // ini kondisi normal kalau pemeriksaan < dibuat; biasanya tidak perlu error di sini
                        // tapi kalau mau beri per-field error:
                        // $validator->errors()->add($field, "Tanggal pemeriksaan tidak boleh lebih kecil dari tanggal dibuat!");
                        // break;
                        // -> saya tidak tambahkan agar hanya satu sumber error (tanggal_dibuat) muncul.
                    }
                }
            }
        }

        // tambahan: validasi tanggal_selesai tidak boleh < tanggal_dibuat
        if ($request->filled('tanggal_selesai') && $tanggalDibuat) {
            $tanggalSelesai = $toCarbonSafe($request->tanggal_selesai);

            if (!$tanggalSelesai) {
                $validator->errors()->add('tanggal_selesai', 'Format tanggal selesai tidak valid (harus dd-mm-yyyy).');
            } else {
                if ($tanggalSelesai->lt($tanggalDibuat)) {
                    $validator->errors()->add(
                        'tanggal_selesai',
                        "Tanggal selesai tidak boleh lebih kecil dari tanggal dibuat!"
                    );
                }
            }
        }
    });
    $validator->validate();


    // Konversi tanggal apabila field input ada isinya
    $toDate = fn($date) => $date 
        ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
        : null;

        // 1. Buat JO & konversi format tanggal ke (Y-m-d) bawwaan laravel
        $jobOrder = JobOrder::create([
        'nama_perusahaan'                   => $request->nama_perusahaan,
        'alamat_perusahaan'                 => $request->alamat_perusahaan,
        'pic_order'                         => $request->pic_order,
        'email'                             => $request->email,
        'contact_person'                    => $request->contact_person,
        'no_penawaran'                      => $request->no_penawaran,
        'no_purcash_order'                  => $request->no_purcash_order,

        'tanggal_pemeriksaan1'              => $toDate($request->tanggal_pemeriksaan1),
        'tanggal_pemeriksaan2'              => $toDate($request->tanggal_pemeriksaan2),
        'tanggal_pemeriksaan3'              => $toDate($request->tanggal_pemeriksaan3),
        'tanggal_pemeriksaan4'              => $toDate($request->tanggal_pemeriksaan4),
        'tanggal_pemeriksaan5'              => $toDate($request->tanggal_pemeriksaan5),

        'jumlah_hari_pemeriksaan'           => $request->jumlah_hari_pemeriksaan,
        'tanggal_selesai'                   => $toDate($request->tanggal_selesai),
        'jam_bertemu'                       => $request->jam_bertemu,
        'jam_selesai'                       => $request->jam_selesai,
        'pic_ditemui'                       => $request->pic_ditemui,
        'contact_person2'                   => $request->contact_person2,
        'nomor_jo'                          => $request->nomor_jo,
        'tanggal_dibuat'                    => $toDate($request->tanggal_dibuat),
        'status_jo'                         => 'belum',
        'kelengkapan_manual_book'           => $request->kelengkapan_manual_book,
        'qty_manual_book'                   => $request->qty_manual_book,
        'kelengkapan_layout'                => $request->kelengkapan_layout,
        'qty_layout'                        => $request->qty_layout,
        'kelengkapan_maintenance_report'    => $request->kelengkapan_maintenance_report,
        'qty_maintenance_report'            => $request->qty_maintenance_report,
        'kelengkapan_surat_permohonan'      => $request->kelengkapan_surat_permohonan,
        'qty_surat_permohonan'              => $request->qty_surat_permohonan,
        'catatan'                           => $request->catatan,
    ]);

        // 2. Simpan alat2
        foreach ($request->tools as $tool) {
            JobOrderTool::create([
                'job_order_id'       => $jobOrder->id,
                'tool_id'            => $tool['tool_id'],
                'qty'                => $tool['qty'],
                'status'             => $tool['status'],
                'kapasitas'          => $tool['kapasitas'],
                'model'              => $tool['model'],
                'no_seri'            => $tool['no_seri'],
                'status_tool'        => 'belum',
                'finished_at'        => null,
            ]);
        }

        // 3. Simpan penanggung jawab (jika ada)
        if ($request->filled('responsibles')) {
            $jobOrder->responsibles()->sync($request->responsibles);
        }

        return redirect()->route('job_orders.index', $jobOrder->id)->with('success', 'Job Order berhasil disimpan!');
    }

    public function show(JobOrder $jobOrder)
    {
        $jobOrder->load(['tools', 'responsibles']); // eager load relasi langsung
        $jobOrder->recalculateStatus(); 
        return view('job_orders.show', [
            'jobOrder' => $jobOrder,
            'title' => 'Job Order',
            'subtitle' => 'Detail Job Order PT. Asteria Riksa Indonesia'
        ]);
    }

    public function edit(JobOrder $jobOrder)
    {
        $jobOrder->load(['tools', 'responsibles']); // eager load relasi langsung
        $petugas = User::role('Tim Riksa Uji')->get(); // ambil user role Tim Riksa Uji
        $tools = Tool::all(); 
        return view('job_orders.edit', [
            'jobOrder' => $jobOrder,
            'petugas' => $petugas,
            'tools' => $tools,
            'title' => 'Job Order',
            'subtitle' => 'Edit Job Order PT. Asteria Riksa Indonesia'
        ]);
    }

    public function update(Request $request, JobOrder $jobOrder)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan'                   => 'required|string|max:255',
            'alamat_perusahaan'                 => 'required|string|max:255',
            'pic_order'                         => 'required|string|max:255',
            'email'                             => 'nullable|email|max:255',
            'contact_person'                    => 'nullable|string|max:255',
            'no_penawaran'                      => 'nullable|string|max:255',
            'no_purcash_order'                  => 'nullable|string|max:255',

            'tanggal_pemeriksaan1'              => 'nullable|string',
            'tanggal_pemeriksaan2'              => 'nullable|string',
            'tanggal_pemeriksaan3'              => 'nullable|string',
            'tanggal_pemeriksaan4'              => 'nullable|string',
            'tanggal_pemeriksaan5'              => 'nullable|string',

            'jumlah_hari_pemeriksaan'           => 'required|integer|min:1',
            'tanggal_selesai'                   => 'required|string',
            'jam_bertemu'                       => 'nullable',
            'jam_selesai'                       => 'nullable',
            'pic_ditemui'                       => 'nullable|string|max:255',
            'contact_person2'                   => 'nullable|string|max:255',
            'tanggal_dibuat'                    => 'required|string',
            'nomor_jo'                          => 'required|string|max:50|unique:job_orders,nomor_jo,' . $jobOrder->id,
            'catatan'                           => 'nullable|string|max:65535',    

            'tools'                             => 'required|array',
            'tools.*.tool_id'                   => 'required|exists:tools,id',
            'tools.*.qty'                       => 'required|integer|min:1',
            'tools.*.status'                    => 'required|string|in:pertama,resertifikasi',
            'tools.*.kapasitas'                 => 'nullable|string|max:255',
            'tools.*.model'                     => 'nullable|string|max:255',
            'tools.*.no_seri'                   => 'nullable|string|max:255',

            'responsibles'                      => 'nullable|array',
            'responsibles.*'                    => 'exists:users,id',
            'kelengkapan_manual_book'           => 'nullable|boolean',
            'qty_manual_book'                   => 'nullable|integer|min:1',
            'kelengkapan_layout'                => 'nullable|boolean',
            'qty_layout'                        => 'nullable|integer|min:1',
            'kelengkapan_maintenance_report'    => 'nullable|boolean',
            'qty_maintenance_report'            => 'nullable|integer|min:1',
            'kelengkapan_surat_permohonan'      => 'nullable|boolean',
            'qty_surat_permohonan'              => 'nullable|integer|min:1',
        ]);
        
        // helper konversi tanggal aman tetap pakai $toDate
        $toDate = function ($date) {
            if (!$date) return null;
            $formats = ['d-m-Y', 'Y-m-d', 'd/m/Y', 'Y/m/d'];
            foreach ($formats as $fmt) {
                try {
                    $dt = Carbon::createFromFormat($fmt, $date);
                    if ($dt) return $dt->format('Y-m-d');
                } catch (\Throwable $e) {
                    continue;
                }
            }
            try {
                return Carbon::parse($date)->format('Y-m-d');
            } catch (\Throwable $e) {
                return null;
            }
        };

        // validator after tetap sama
        $validator->after(function ($validator) use ($request) {
            $toCarbonSafe = function ($value) {
                if (!$value) return null;
                $preferredFormats = ['d-m-Y', 'Y-m-d', 'd/m/Y', 'Y/m/d'];
                foreach ($preferredFormats as $fmt) {
                    $dt = \Carbon\Carbon::createFromFormat($fmt, $value);
                    if ($dt && $dt->format($fmt) === $value) {
                        return $dt->startOfDay();
                    }
                }
                try {
                    return \Carbon\Carbon::parse($value)->startOfDay();
                } catch (\Throwable $e) {
                    return null;
                }
            };

            $tanggalDibuat = $toCarbonSafe($request->tanggal_dibuat);

            if ($request->filled('tanggal_dibuat') && !$tanggalDibuat) {
                $validator->errors()->add('tanggal_dibuat', 'Format tanggal dibuat tidak valid (harus dd-mm-yyyy).');
                return;
            }

            if ($tanggalDibuat) {
                foreach (range(1, 5) as $i) {
                    $field = "tanggal_pemeriksaan{$i}";
                    if ($request->filled($field)) {
                        $tanggalPemeriksaan = $toCarbonSafe($request->$field);
                        if (!$tanggalPemeriksaan) {
                            $validator->errors()->add($field, "Format {$field} tidak valid (harus dd-mm-yyyy).");
                            break;
                        }
                        if ($tanggalDibuat->gt($tanggalPemeriksaan)) {
                            $validator->errors()->add(
                                'tanggal_dibuat',
                                "Tanggal JO dibuat harus sama atau lebih dari tanggal pemeriksaan!"
                            );
                            break;
                        }
                    }
                }
            }

            if ($request->filled('tanggal_selesai') && $tanggalDibuat) {
                $tanggalSelesai = $toCarbonSafe($request->tanggal_selesai);
                if (!$tanggalSelesai) {
                    $validator->errors()->add('tanggal_selesai', 'Format tanggal selesai tidak valid (harus dd-mm-yyyy).');
                } else if ($tanggalSelesai->lt($tanggalDibuat)) {
                    $validator->errors()->add(
                        'tanggal_selesai',
                        "Tanggal selesai tidak boleh lebih kecil dari tanggal dibuat!"
                    );
                }
            }
        });
        // Jalankan validasi
        $validator->validate();

        // update JO
        $jobOrder->update([
            'nama_perusahaan'                   => $request->nama_perusahaan,
            'alamat_perusahaan'                 => $request->alamat_perusahaan,
            'pic_order'                         => $request->pic_order,
            'email'                             => $request->email,
            'contact_person'                    => $request->contact_person,
            'no_penawaran'                      => $request->no_penawaran,
            'no_purcash_order'                  => $request->no_purcash_order,

            'tanggal_pemeriksaan1'              => $toDate($request->tanggal_pemeriksaan1),
            'tanggal_pemeriksaan2'              => $toDate($request->tanggal_pemeriksaan2),
            'tanggal_pemeriksaan3'              => $toDate($request->tanggal_pemeriksaan3),
            'tanggal_pemeriksaan4'              => $toDate($request->tanggal_pemeriksaan4),
            'tanggal_pemeriksaan5'              => $toDate($request->tanggal_pemeriksaan5),

            'jumlah_hari_pemeriksaan'           => $request->jumlah_hari_pemeriksaan,
            'tanggal_selesai'                   => $toDate($request->tanggal_selesai),
            'jam_bertemu'                       => $request->jam_bertemu,
            'jam_selesai'                       => $request->jam_selesai,
            'pic_ditemui'                       => $request->pic_ditemui,
            'contact_person2'                   => $request->contact_person2,
            'nomor_jo'                          => $request->nomor_jo,
            'tanggal_dibuat'                    => $toDate($request->tanggal_dibuat),
            'kelengkapan_manual_book'           => $request->boolean('kelengkapan_manual_book'),
            'qty_manual_book'                   => $request->qty_manual_book,
            'kelengkapan_layout'                => $request->boolean('kelengkapan_layout'),
            'qty_layout'                        => $request->qty_layout,
            'kelengkapan_maintenance_report'    => $request->boolean('kelengkapan_maintenance_report'),
            'qty_maintenance_report'            => $request->qty_maintenance_report,
            'kelengkapan_surat_permohonan'      => $request->boolean('kelengkapan_surat_permohonan'),
            'qty_surat_permohonan'              => $request->qty_surat_permohonan,
            'catatan'                           => $request->catatan,
        ]);

        // --- Sinkronisasi tools tanpa menghapus data pemeriksaan (form KP) ---
        // Ambil semua tool lama yang sudah ada di pivot
        $existingTools = JobOrderTool::where('job_order_id', $jobOrder->id)
            ->get()
            ->keyBy('tool_id'); // agar mudah dicari berdasarkan tool_id

        foreach ($request->tools as $tool) {
            $toolId = $tool['tool_id'];

            if ($existingTools->has($toolId)) {
                // UPDATE tool lama (tanpa mengubah finished_at dan status pemeriksaan)
                $existingTools[$toolId]->update([
                    'qty'       => $tool['qty'],
                    'status'    => $tool['status'],
                    'kapasitas' => $tool['kapasitas'],
                    'model'     => $tool['model'],
                    'no_seri'   => $tool['no_seri'],
                ]);

                // Hapus dari daftar existingTools agar tidak dianggap sisa
                $existingTools->forget($toolId);

            } else {
                // CREATE tool baru jika belum terdaftar di JO
                JobOrderTool::create([
                    'job_order_id' => $jobOrder->id,
                    'tool_id'      => $toolId,
                    'qty'          => $tool['qty'],
                    'status'       => $tool['status'],
                    'kapasitas'    => $tool['kapasitas'],
                    'model'        => $tool['model'],
                    'no_seri'      => $tool['no_seri'],
                    'finished_at'  => null, // baru ditambahkan, belum diperiksa
                ]);
            }
        }

        // Tools yang tersisa di $existingTools = alat yang dihapus dari input form
        // Boleh dihapus (akan menghapus form KP terkait jika FK cascade)
        foreach ($existingTools as $toolToDelete) {
            $toolToDelete->delete();
        }

        // Recalculate status tetap dijalankan
        $jobOrder->recalculateStatus();

        // update penanggung jawab
        if ($request->filled('responsibles')) {
            $jobOrder->responsibles()->sync($request->responsibles);
        } else {
            $jobOrder->responsibles()->sync([]);
        }


        return redirect()->route('job_orders.index')->with('success', 'Job Order berhasil diperbarui!');
    }

    public function destroy(JobOrder $jobOrder)
    {
        $jobOrder->delete();
        return redirect()->route('job_orders.index')->with('success', 'Job Order berhasil dihapus!');
    }
}
