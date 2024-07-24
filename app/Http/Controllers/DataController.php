<?php

namespace App\Http\Controllers;

use App\Models\Data;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Data::all();
        return view('movie.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movie.create');
    }

    /**
     * Format duration in seconds to a human-readable format.
     */
    private function formatDuration($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        $duration = '';
        if ($hours > 0) {
            $duration .= $hours . 'h ';
        }
        if ($minutes > 0) {
            $duration .= $minutes . 'm ';
        }
        if ($seconds > 0 || $duration == '') {
            $duration .= $seconds . 's';
        }

        return trim($duration);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $bannerPath = '';
    $videoPath = '';

    $request->validate([
        'judul' => 'required|string|max:255',
        'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'desk' => 'required|string',
        'video' => 'required|mimes:mp4,mov,avi|max:501200',
        'tipe' => 'required|string|max:255',
    ]);

    if ($request->hasFile('banner')) {
        try {
            $bannerPath = $request->file('banner')->store('banners', 'public');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunggah banner.');
        }
    }

    if ($request->hasFile('video')) {
        try {
            $videoPath = $request->file('video')->store('videos', 'public');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunggah video.');
        }
    }

    $getID3 = new getID3;
    try {
        $videoFilePath = storage_path('app/public/' . $videoPath);
        $fileInfo = $getID3->analyze($videoFilePath);
        $durationInSeconds = isset($fileInfo['playtime_seconds']) ? $fileInfo['playtime_seconds'] : 0;
        $formattedDuration = $this->formatDuration($durationInSeconds);
    } catch (\Exception $e) {
        $formattedDuration = 'Unknown';
    }

    Data::create([
        'judul' => $request->judul,
        'banner' => $bannerPath,
        'desk' => $request->desk,
        'video' => $videoPath,
        'tipe' => $request->tipe,
        'durasi' => $formattedDuration,
    ]);

    return redirect()->route('movie.index')->with('success', 'Data berhasil ditambahkan!');
}


    public function edit(string $id)
    {
        $item = Data::find($id);
        return view('movie.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desk' => 'required|string',
            'video' => 'nullable|mimes:mp4,mov,avi|max:501200', // 50 MB
            'tipe' => 'required|string|max:255',
        ]);

        // Temukan data berdasarkan ID
        $data = Data::findOrFail($id);

        // Update file banner jika ada
        if ($request->hasFile('banner')) {
            // Hapus banner lama
            Storage::delete($data->banner);
            $bannerPath = $request->file('banner')->store('banners', 'public');
        } else {
            $bannerPath = $data->banner;
        }

        // Update file video jika ada
        if ($request->hasFile('video')) {
            // Hapus video lama
            Storage::delete($data->video);
            $videoPath = $request->file('video')->store('videos', 'public');

            // Dapatkan durasi video baru
            $getID3 = new \getID3;
            $fileInfo = $getID3->analyze(storage_path('app/public/' . $videoPath));
            $durationInSeconds = isset($fileInfo['playtime_seconds']) ? $fileInfo['playtime_seconds'] : 0;

            // Format durasi
            $formattedDuration = $this->formatDuration($durationInSeconds);
        } else {
            $videoPath = $data->video;
            $formattedDuration = $data->durasi;
        }

        // Update data di database
        $data->update([
            'judul' => $request->judul,
            'banner' => $bannerPath,
            'desk' => $request->desk,
            'video' => $videoPath,
            'tipe' => $request->tipe,
            'durasi' => $formattedDuration,
        ]);

        // Redirect setelah menyimpan data
        return redirect()->route('movie.index')->with('success', 'Data berhasil diperbarui!');
    }


    public function destroy(string $id)
    {
        $data = Data::find($id);
        // Hapus file banner jika path tidak null
        if ($data->banner && Storage::exists($data->banner)) {
            Storage::delete($data->banner);
        }

        // Hapus file video jika path tidak null
        if ($data->video && Storage::exists($data->video)) {
            Storage::delete($data->video);
        }

        // Hapus entri dari database
        $data->delete();

        // Redirect atau kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('movie.index')->with('success', 'Data berhasil dihapus!');
    }
}
