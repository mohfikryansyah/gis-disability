<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAplikasi;
use Illuminate\Http\Request;

class PengaturanAplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PengaturanAplikasi $pengaturanAplikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengaturanAplikasi $pengaturanAplikasi)
    {
        return view('pages.dashboard.pengaturan.edit', compact('pengaturanAplikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengaturanAplikasi $pengaturanAplikasi)
    {
        $validatedData = $request->validate([
            'judul_utama_baris_1' => 'required|string|max:18',
            'judul_utama_baris_2' => 'required|string|max:18',
            'judul_utama_baris_3' => 'required|string|max:18',
            'fitur_1' => 'required|string|max:255',
            'fitur_2' => 'required|string|max:255',
            'fitur_3' => 'required|string|max:255',
            'judul_fitur_1' => 'required|string|max:20',
            'judul_fitur_2' => 'required|string|max:20',
            'judul_fitur_3' => 'required|string|max:20',
            'gambar_utama' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar_utama')) {
            $validatedData['gambar_utama'] = $request->file('gambar_utama')->store('pengaturan-aplikasi', 'public');
        }

        $pengaturanAplikasi->update($validatedData);

        return redirect()->route('dashboard.pengaturan.aplikasi.edit', $pengaturanAplikasi)->with('success', 'Pengaturan aplikasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengaturanAplikasi $pengaturanAplikasi)
    {
        //
    }
}
