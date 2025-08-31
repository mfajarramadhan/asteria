<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

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
        return view('tools.create', [
            'title' => 'Tambah Alat', 
            'subtitle' => 'Tambah alat riksa uji PT. Asteria Riksa Indonesia'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
        ]);
         // Jika ada gambar baru (upload)
        if($request->file('lampiran')){
            // simpan ke dalam folder post-images
            $validateData['lampiran'] = $request->file('lampiran')->store('lampiran-images');
        }
        // Jika tidak ada gambar baru, maka biarkan saja

        Tool::create($validateData);
        return redirect()->route('tools.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        return view('tools.edit', compact('tool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'jenis_alat' => 'required|string|max:255',
        ]);

        $tool->update($request->all());
        return redirect()->route('tools.index')->with('success', 'Alat berhasil diperbarui');
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
