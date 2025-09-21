<?php
namespace App\Http\Controllers;

use App\Models\FormKpBejanaTekan;
use Illuminate\Http\Request;
use App\Models\JobOrderTool;

class FormKpBejanaTekanController extends Controller
{

public function index()
{
    $tools = JobOrderTool::with(['jobOrder', 'tool'])
        ->where('status_tool', 'selesai')
        ->whereHas('tool', function ($q) {
            $q->where('jenis_riksa_uji_id', 1)
              ->where('sub_jenis_riksa_uji_id', 1);
        })
        ->get();

    return view('form_kp.pubt.bejana_tekan.index', [
        'title' => 'Form KP Bejana Tekan',
        'subtitle' => 'Daftar alat yang selesai',
        'tools' => $tools,
    ]);
}


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.pubt.bejana_tekan.create', [
            'title'         => 'Form KP Bejana Tekan',
            'subtitle'         => 'Isi Form KP Bejana Tekan',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);

        // validasi input
        $validated = $request->validate([
            'hasil_pemeriksaan' => 'required|string',
            'catatan'           => 'nullable|string',
        ]);

        // simpan ke form_kp_bejana_tekans
        $form = $jobOrderTool->formKpBejanaTekan()->create($validated);

        // update status alat
        $jobOrderTool->update([
            'status_tool' => 'selesai',
        ]);

        return redirect()->route('form_kp.pubt.bejana_tekan.index')
            ->with('success', 'Form pemeriksaan Bejana Tekan berhasil disimpan.');
    }
}
