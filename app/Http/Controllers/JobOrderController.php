<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\JobOrderTool;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        $petugas = User::role('petugas')->get(); // ambil user role petugas

        return view('job_orders.create', [
            'tools' => $tools,
            'petugas' => $petugas,
            'title' => 'Job Order',
            'subtitle' => 'Buat Job Order PT. Asteria Riksa Indonesia'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama_perusahaan'       => 'required|string|max:255',
        'alamat_perusahaan'     => 'required|string|max:255',
        'pic_order'             => 'required|string|max:255',
        'email'                 => 'nullable|email|max:255',
        'contact_person'        => 'nullable|string|max:255',
        'no_penawaran'          => 'nullable|string|max:255',
        'no_purcash_order'      => 'nullable|string|max:255',

        'tanggal_pemeriksaan1'  => 'nullable|date',
        'tanggal_pemeriksaan2'  => 'nullable|date',
        'tanggal_pemeriksaan3'  => 'nullable|date',
        'tanggal_pemeriksaan4'  => 'nullable|date',
        'tanggal_pemeriksaan5'  => 'nullable|date',

        'jumlah_hari_pemeriksaan' => 'required|integer|min:1',
        'tanggal_selesai'       => 'nullable|date',
        'jam_bertemu'           => 'nullable|date_format:H:i',
        'jam_selesai'           => 'nullable|date_format:H:i',
        'pic_ditemui'           => 'nullable|string|max:255',
        'contact_person2'       => 'nullable|string|max:255',
        'tanggal_dibuat'        => 'required|date',
        'nomor_jo'              => 'required|string|max:50|unique:job_orders,nomor_jo',

        'tools'                 => 'required|array',
        'tools.*.tool_id'       => 'required|exists:tools,id',
        'tools.*.qty'           => 'required|integer|min:1',
        'tools.*.status_pemeriksaan' => 'required|string|in:pertama,resertifikasi',

        'responsibles'          => 'nullable|array',
        'responsibles.*'        => 'exists:users,id'
    ]);

    // Konversi tanggal apabila field input ada isinya
    $toDate = fn($date) => $date 
        ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
        : null;

        // 1. Buat JO & konversi format tanggal ke (Y-m-d) bawwaan laravel
        $jobOrder = JobOrder::create([
        'nama_perusahaan'       => $request->nama_perusahaan,
        'alamat_perusahaan'     => $request->alamat_perusahaan,
        'pic_order'             => $request->pic_order,
        'email'                 => $request->email,
        'contact_person'        => $request->contact_person,
        'no_penawaran'          => $request->no_penawaran,
        'no_purcash_order'      => $request->no_purcash_order,

        'tanggal_pemeriksaan1'  => $toDate($request->tanggal_pemeriksaan1),
        'tanggal_pemeriksaan2'  => $toDate($request->tanggal_pemeriksaan2),
        'tanggal_pemeriksaan3'  => $toDate($request->tanggal_pemeriksaan3),
        'tanggal_pemeriksaan4'  => $toDate($request->tanggal_pemeriksaan4),
        'tanggal_pemeriksaan5'  => $toDate($request->tanggal_pemeriksaan5),

        'jumlah_hari_pemeriksaan' => $request->jumlah_hari_pemeriksaan,
        'tanggal_selesai'       => $toDate($request->tanggal_selesai),
        'jam_bertemu'           => $request->jam_bertemu,
        'jam_selesai'           => $request->jam_selesai,
        'pic_ditemui'           => $request->pic_ditemui,
        'contact_person2'       => $request->contact_person2,
        'nomor_jo'              => $request->nomor_jo,
        'tanggal_dibuat'        => $toDate($request->tanggal_dibuat),
        'status'                => 'belum',
    ]);

        // 2. Simpan alat2
        foreach ($request->tools as $toolData) {
            JobOrderTool::create([
                'job_order_id'       => $jobOrder->id,
                'tool_id'            => $toolData['tool_id'],
                'qty'                => $toolData['qty'],
                'status_pemeriksaan'  => $toolData['status_pemeriksaan'],
                'status'             => 'belum',
                'kelengkapan'        => null,
                'finished_at'        => null,
            ]);
        }

        // 3. Simpan penanggung jawab (jika ada)
        if ($request->filled('responsibles')) {
            $jobOrder->responsibles()->sync($request->responsibles);
        }

        return redirect()->route('job_orders.index', $jobOrder->id)->with('success', 'Job Order berhasil dibuat');
    }

    public function show(JobOrder $jobOrder)
    {
        $jobOrder->load(['tools.tool', 'responsibles']); // eager load relasi
        return view('job_orders.show', compact('jobOrder'));
    }
}
