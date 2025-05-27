<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use App\Models\District;
use App\Models\Penyandang;
use App\Models\Persebaran;
use Illuminate\Http\Request;
use App\Http\Requests\StorePersebaranRequest;
use App\Http\Requests\UpdatePersebaranRequest;
use App\Models\Layanan;

class PersebaranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('jenis_disabilitas')) {
            $jenisDisabilitas = $request->jenis_disabilitas ?? null;
            $penyandang = Penyandang::where('jenis_disabilitas', $jenisDisabilitas)->get();
        } else {
            $jenisDisabilitas = null;
            $penyandang = Penyandang::all();
        }
        $relawan = Relawan::all();
        $districts = District::with('relawan', 'penyandang')->get();
        $layanan = Layanan::all();

        return view('pages.dashboard.persebaran.index', compact('penyandang', 'districts', 'relawan', 'jenisDisabilitas', 'layanan'));
    }

    public function create()
    {
        //
    }

    public function store(StorePersebaranRequest $request)
    {
        //
    }

    public function show(Persebaran $persebaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persebaran $persebaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersebaranRequest $request, Persebaran $persebaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persebaran $persebaran)
    {
        //
    }
}
