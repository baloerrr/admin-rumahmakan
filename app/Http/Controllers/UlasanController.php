<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ulasans = Ulasan::all();
        return view('ulasan.index', compact('ulasans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ulasan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'email' => 'required|email|max:255',
        ]);

        Ulasan::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'email' => $request->email,
        ]);

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ulasan $ulasan)
    {
        return view('ulasan.show', compact('ulasan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ulasan $ulasan)
    {
        return view('ulasan.edit', compact('ulasan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ulasan $ulasan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'email' => 'required|email|max:255',
        ]);

        $ulasan->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'email' => $request->email,
        ]);

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil dihapus!');
    }
}
