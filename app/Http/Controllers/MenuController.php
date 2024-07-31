<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product' => 'required|array',
            'product.*' => 'string', // Validate each item in the product array
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('images', 'public');
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to upload image.');
            }
        }

        Menu::create([
            'title' => $request->title,
            'image' => $imagePath,
            'product' => json_encode($request->product),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product' => 'required|array',
            'product.*' => 'string', // Validate each item in the product array
        ]);

        $imagePath = $menu->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menu->image && Storage::exists($menu->image)) {
                Storage::delete($menu->image);
            }
            try {
                $imagePath = $request->file('image')->store('images', 'public');
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to upload image.');
            }
        }

        $menu->update([
            'title' => $request->title,
            'image' => $imagePath,
            'product' => json_encode($request->product),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Delete image if exists
        if ($menu->image && Storage::exists($menu->image)) {
            Storage::delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu successfully deleted!');
    }
}
