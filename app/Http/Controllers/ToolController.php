<?php

namespace App\Http\Controllers;

use App\Models\JenisRiksaUji;
use App\Models\Tool;
use Illuminate\Http\Request;
use App\Models\SubJenisRiksaUji;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tools = Tool::all();
        return view('tools.index', [
            'tools' => $tools, 
            'title' => 'Daftar Alat', 
            'subtitle' => 'Daftar alat riksa uji PT. Asteria Riksa Indonesia'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisRiksaUji = JenisRiksaUji::all(['id', 'jenis']);
        $subJenisRiksaUji = SubJenisRiksaUji::all(['id', 'sub_jenis']);
        return view('tools.create', [
            'title' => 'Tambah Alat', 
            'subtitle' => 'Tambah alat riksa uji PT. Asteria Riksa Indonesia',
            'jenisRiksaUji' => $jenisRiksaUji,
            'subJenisRiksaUji' => $subJenisRiksaUji,
        ]);
    }

        /**
     * AJAX: return sub-jenis yang punya jenis_riksa_uji_id = $jenisId
     */
    public function subJenis($jenisId)
    {
        $sub = SubJenisRiksaUji::where('jenis_riksa_uji_id', $jenisId)
               ->orderBy('sub_jenis')
               ->get(['id', 'sub_jenis']);

        return response()->json($sub);
    }

    
    /**
     * Store new tool.
     * Validasi memastikan jenis dan sub_jenis ada, dan sub_jenis memang milik jenis yang dipilih.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_riksa_uji_id' => 'required|exists:jenis_riksa_ujis,id',
            'sub_jenis_riksa_uji_id' => 'required|exists:sub_jenis_riksa_ujis,id',
        ]);

        // Memastikan sub_jenis yg dipilih milik jenis yg sama (cegah manipulasi request)
        $sub = SubJenisRiksaUji::find($data['sub_jenis_riksa_uji_id']);
        if (!$sub || $sub->jenis_riksa_uji_id != $data['jenis_riksa_uji_id']) {
            return back()
                ->withInput()
                ->withErrors(['sub_jenis_riksa_uji_id' => 'Sub-jenis tidak valid untuk jenis yang dipilih.']);
        }

        // Buat tool
        $tool = new Tool();
        $tool->nama = $data['nama']; 
        $tool->jenis_riksa_uji_id = $data['jenis_riksa_uji_id']; 
        $tool->sub_jenis_riksa_uji_id = $data['sub_jenis_riksa_uji_id']; 
        $tool->save();

        return redirect()->route('tools.index')->with('success', 'Alat berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        return view('tools.show', [
            'tool' => $tool, 
            'title' => 'Detail alat',
            'subtitle' => ''
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        $jenisRiksaUji = JenisRiksaUji::all(['id', 'jenis']);
        $subJenisRiksaUji = SubJenisRiksaUji::all(['id', 'sub_jenis']);
        return view('tools.edit', [
            'tool' => $tool,
            'title' => 'Edit Alat', 
            'subtitle' => 'Edit alat riksa uji PT. Asteria Riksa Indonesia',
            'jenisRiksaUji' => $jenisRiksaUji,
            'subJenisRiksaUji' => $subJenisRiksaUji,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_riksa_uji_id' => 'required|exists:jenis_riksa_ujis,id',
            'sub_jenis_riksa_uji_id' => 'required|exists:sub_jenis_riksa_ujis,id',
        ]);

        // Pastikan sub_jenis valid untuk jenis yg dipilih
        $sub = SubJenisRiksaUji::find($data['sub_jenis_riksa_uji_id']);
        if (!$sub || $sub->jenis_riksa_uji_id != $data['jenis_riksa_uji_id']) {
            return back()
                ->withInput()
                ->withErrors(['sub_jenis_riksa_uji_id' => 'Sub-jenis tidak valid untuk jenis yang dipilih.']);
        }

        // Cari tool
        $tool = Tool::findOrFail($id);

        // Update data
        $tool->nama = $data['nama'];
        $tool->jenis_riksa_uji_id = $data['jenis_riksa_uji_id'];
        $tool->sub_jenis_riksa_uji_id = $data['sub_jenis_riksa_uji_id'];
        $tool->save();

        return redirect()->route('tools.index')->with('success', 'Alat berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->route('tools.index')->with('success', 'Alat berhasil dihapus!');
    }
}
