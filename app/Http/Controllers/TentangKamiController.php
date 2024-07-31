<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangKamiController extends Controller
{
    public function index()
    {
        $tentangKamis = TentangKami::all();
        return view('tentangkami.index', compact('tentangKamis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tentangkami.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
        }

        TentangKami::create([
            'title' => $request->title,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'banner' => $bannerPath,
        ]);

        return redirect()->route('tentang-kami.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TentangKami $tentangKami)
    {
        return view('tentangkami.show', compact('tentangKami'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TentangKami $tentangKami)
    {
        return view('tentangkami.edit', compact('tentangKami'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TentangKami $tentangKami)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $bannerPath = $tentangKami->banner;
        if ($request->hasFile('banner')) {
            if ($tentangKami->banner) {
                Storage::delete('public/' . $tentangKami->banner);
            }
            $bannerPath = $request->file('banner')->store('banners', 'public');
        }

        $tentangKami->update([
            'title' => $request->title,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'banner' => $bannerPath,
        ]);

        return redirect()->route('tentang-kami.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TentangKami $tentangKami)
    {
        if ($tentangKami->banner) {
            Storage::delete('public/' . $tentangKami->banner);
        }

        $tentangKami->delete();

        return redirect()->route('tentang-kami.index')->with('success', 'Data berhasil dihapus!');
    }
}
