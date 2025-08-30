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
        return view('tools.index', compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'jenis_alat' => 'required|string|max:255',
        ]);

        Tool::create($request->all());
        return redirect()->route('tools.index')->with('success', 'Alat berhasil ditambahkan');
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
        return redirect()->route('tools.index')->with('success', 'Alat berhasil dihapus');
    }
}
