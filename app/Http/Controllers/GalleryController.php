<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('pages.dashboard.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|mimes:png,jpg,jpeg|file|max:1024',
            'deskripsi' => 'required|max:200',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('gallery', 'public');

            $photo = new Gallery();
            $photo->file_path = $path;
            $photo->deskripsi = $request->deskripsi;
            $photo->save();
        }

        return redirect()->route('dashboard.gallery.index')->with('success', 'Foto berhasil diunggah!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $gallery = Gallery::findOrFail($gallery->id);
        return view('pages.dashboard.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'nullable|mimes:png,jpg,jpeg|file|max:1024',
            'deskripsi' => 'sometimes|string|max:200'
        ]);

        $gallery = Gallery::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
                Storage::disk('public')->delete($gallery->file_path);
            }

            $path = $request->file('foto')->store('gallery', 'public');

            $gallery->file_path = $path;
        }

        $gallery->deskripsi = $request->deskripsi;
        $gallery->save();

        return redirect()->route('dashboard.gallery.index')->with('success', 'Foto dan deskripsi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if (Storage::exists($gallery->file_path)) {
            Storage::delete($gallery->file_path);
        }

        $gallery->delete();

        return redirect()->route('dashboard.gallery.index')->with('success', 'Foto berhasil dihapus!');
    }
}
