<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Relawan;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.layanan.index', [
            'layanan' => Layanan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::all();
        $relawan = Relawan::all();
        return view('pages.dashboard.layanan.create', compact('districts', 'relawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kontak' => 'required',
            'dokumentasi' => 'required|image|max:2048',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $validatedData['dokumentasi'] = $request->file('dokumentasi')->store('layanan', 'public');

        if ($validatedData['jenis'] === 'Fasilitas Fisik dan Aksesibilitas') {
            $validatedData['icon'] = 'icons/layanan-fisik.png';
        } elseif ($validatedData['jenis'] === 'Layanan Pendidikan') {
            $validatedData['icon'] = 'icons/layanan-pendidikan.png';
        } elseif ($validatedData['jenis'] === 'Dukungan Sosial dan Ekonomi') {
            $validatedData['icon'] = 'icons/layanan-sosial.png';
        } else {
            $validatedData['icon'] = 'icons/layanan-pendidikan.png';
        }

        Layanan::create($validatedData);

        return redirect()->route('dashboard.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        return view('pages.dashboard.layanan.show', [
            'layanan' => $layanan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('pages.dashboard.layanan.edit', [
            'layanan' => $layanan,
            'districts' => District::all(),
            'relawan' => Relawan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kontak' => 'required',
            'dokumentasi' => 'nullable|image|max:2048', // nullable karena tidak wajib diupdate
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        // Handle file upload jika ada file baru
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama jika ada
            if ($layanan->dokumentasi && Storage::disk('public')->exists($layanan->dokumentasi)) {
                Storage::disk('public')->delete($layanan->dokumentasi);
            }

            // Upload file baru
            $validatedData['dokumentasi'] = $request->file('dokumentasi')->store('layanan', 'public');
        } else {
            // Jika tidak ada file baru, hapus dokumentasi dari validatedData agar tidak di-update
            unset($validatedData['dokumentasi']);
        }

        // Set icon berdasarkan jenis layanan
        if ($validatedData['jenis'] === 'Fasilitas Fisik dan Aksesibilitas') {
            $validatedData['icon'] = 'icons/layanan-fisik.png';
        } elseif ($validatedData['jenis'] === 'Layanan Pendidikan') {
            $validatedData['icon'] = 'icons/layanan-pendidikan.png';
        } elseif ($validatedData['jenis'] === 'Dukungan Sosial dan Ekonomi') {
            $validatedData['icon'] = 'icons/layanan-sosial.png';
        } else {
            $validatedData['icon'] = 'icons/layanan-pendidikan.png';
        }

        // Update data
        $layanan->update($validatedData);

        return redirect()->route('dashboard.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('dashboard.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
