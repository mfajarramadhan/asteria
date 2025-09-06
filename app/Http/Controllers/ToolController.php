<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
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
            'lampiran' => 'nullable|array',
            'lampiran.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'deskripsi' => 'nullable|string|max:65535'    
        ]);
        // // Untuk menampung 1 foto
        // if($request->file('lampiran')){
        //     // simpan ke dalam folder post-images
        //     $validateData['lampiran'] = $request->file('lampiran')->store('lampiran-images', 'public');
        // }

        // Untuk menampung json multiple foto gunakan array kosong 
        $lampiranPaths = [];

        // Default deskripsi "-"
        $validateData['deskripsi'] = $validateData['deskripsi'] ?? '-';

        // Jika ada gambar baru (upload)
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                // Simpan tiap file ke storage/app/public/lampiran-images
                $path = $file->store('lampiran-images', 'public');
                $lampiranPaths[] = $path;
            }
        }
        // Jika tidak ada gambar baru, maka biarkan saja

        // Simpan sebagai JSON ke database
        $validateData['lampiran'] = json_encode($lampiranPaths);

        Tool::create($validateData);
        return redirect()->route('tools.index')->with('success', 'Alat berhasil ditambahkan!');
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
        return view('tools.edit', [
            'tool' => $tool,
            'title' => 'Edit Alat', 
            'subtitle' => 'Edit alat riksa uji PT. Asteria Riksa Indonesia'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        $validateData = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'lampiran' => 'nullable|array',
            'lampiran.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'deskripsi' => 'nullable|string|max:65535'    
        ]);

        // Default deskripsi "-"
        $validateData['deskripsi'] = $validateData['deskripsi'] ?? '-';

        // Ambil lampiran lama dari database
        $lampiranPaths = $tool->lampiran ? json_decode($tool->lampiran, true) : [];

        // Jika ada gambar baru
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $path = $file->store('lampiran-images', 'public');
                $lampiranPaths[] = $path;
            }
        }

        // Simpan array JSON ke DB
        $validateData['lampiran'] = json_encode($lampiranPaths);

        $tool->update($validateData);
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
