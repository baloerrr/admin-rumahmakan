<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeries = Galery::all();
        return view('galery.index', compact('galeries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'classname' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('galeries', 'public');
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal mengunggah gambar.');
            }
        }

        Galery::create([
            'classname' => $request->classname,
            'image' => $imagePath,
        ]);

        return redirect()->route('galery.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galery $galery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $galery = Galery::find($id);
        return view('galery.edit', compact('galery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'classname' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galery = Galery::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($galery->image) {
                Storage::delete('public/' . $galery->image);
            }
            $imagePath = $request->file('image')->store('galeries', 'public');
        } else {
            $imagePath = $galery->image;
        }

        $galery->update([
            'classname' => $request->classname,
            'image' => $imagePath,
        ]);

        return redirect()->route('galery.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galery $galery, $id)
    {
        $galery = Galery::find($id);

        if ($galery->image && Storage::exists('public/' . $galery->image)) {
            Storage::delete('public/' . $galery->image);
        }

        $galery->delete();

        return redirect()->route('galery.index')->with('success', 'Galeri berhasil dihapus!');
    }
}
