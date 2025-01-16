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
            'fotos.*' => 'required|mimes:png,jpg,jpeg|file|max:1024'
        ]);

        $savedPaths = [];

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $path = $file->store('gallery', 'public');
                $savedPaths[] = $path;

                $photo = new Gallery();
                $photo->file_path = $path;
                $photo->save();
            }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Hapus file dari storage
        if (Storage::exists($gallery->file_path)) {
            Storage::delete($gallery->file_path);
        }

        // Hapus data dari database
        $gallery->delete();

        return redirect()->route('dashboard.gallery.index')->with('success', 'Foto berhasil dihapus!');
    }
}
