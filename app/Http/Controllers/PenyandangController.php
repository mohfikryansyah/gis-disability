<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenyandangRequest;
use App\Http\Requests\UpdatePenyandangRequest;
use App\Models\District;
use App\Models\Penyandang;
use App\Models\Relawan;

class PenyandangController extends Controller
{
    public function index()
    {
        $query = Penyandang::query();

        if (auth()->user()->isRelawan()) {
            $query->where('district_id', auth()->user()->relawan->district_id);
        }

        $penyandang = $query->get();

        $districts = District::all();

        return view('pages.dashboard.master.penyandang.index', compact('penyandang', 'districts'));
    }

    public function create()
    {
        $districts = District::all();
        $relawan = Relawan::all();

        return view('pages.dashboard.master.penyandang.create', compact('districts', 'relawan'));
    }

    public function store(StorePenyandangRequest $request)
    {
        // dd($request->all());
        try {
            $foto_diri = $request->file('foto_diri')->store('public/public/foto_diri');
            $foto_ktp = $request->file('foto_ktp')->store('public/public/foto_ktp');
            $foto_kk = $request->file('foto_kk')->store('public/public/foto_kk');
            $foto_usaha = $request->hasFile('foto_usaha') ? $request->file('foto_usaha')->store('public/public/foto_usaha') : null;
            $foto_rumah = $request->hasFile('foto_rumah') ? $request->file('foto_rumah')->store('public/public/foto_rumah') : null;

            Penyandang::create([
                'relawan_id' => $request->relawan_id,
                'district_id' => $request->district_id,
                'nama' => $request->nama,
                'no_induk_disabilitas' => $request->no_induk_disabilitas,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'jenis_kelamin' => $request->jenis_kelamin,
                'masa_pendidikan' => $request->masa_pendidikan,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'status_pernikahan' => $request->status_pernikahan,
                'keterampilan' => $request->keterampilan,
                'usaha' => $request->usaha,
                'kontak' => $request->kontak,
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'jenis_disabilitas' => $request->jenis_disabilitas,
                // 'keterangan_meninggal' => $request->keterangan_meninggal,
                // 'keterangan_sembuh' => $request->keterangan_sembuh,
                'keterangan' => $request->keterangan,
                'foto_diri' => basename($foto_diri),
                'foto_ktp' => basename($foto_ktp),
                'foto_kk' => basename($foto_kk),
                'foto_usaha' => $foto_usaha ? basename($foto_usaha) : null,
                'foto_rumah' => $foto_rumah ? basename($foto_rumah) : null,
            ]);

            return redirect()->route("dashboard.master.penyandang.index")->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(Penyandang $penyandang)
    {
        if (auth()->user()->isRelawan()) {
            if ($penyandang->district_id != auth()->user()->relawan->district_id) {
                return redirect()->back()->withErrors('Akses tidak sah.');
            }
        }
        return view('pages.dashboard.master.penyandang.show', compact('penyandang'));
    }

    public function edit(Penyandang $penyandang)
    {
        $districts = District::all();

        return view('pages.dashboard.master.penyandang.edit', compact('penyandang', 'districts'));
    }

    public function update(UpdatePenyandangRequest $request, Penyandang $penyandang)
    {
        try {
            if ($request->has('foto_diri')) {
                $foto_diri = basename($request->file('foto_diri')->store('public/foto_diri'));
            }

            if ($request->has('foto_ktp')) {
                $foto_ktp = basename($request->file('foto_ktp')->store('public/foto_ktp'));
            }

            if ($request->has('foto_kk')) {
                $foto_kk = basename($request->file('foto_kk')->store('public/foto_kk'));
            }

            if ($request->has('foto_usaha')) {
                $foto_usaha = basename($request->file('foto_usaha')->store('public/foto_usaha'));
            }

            if ($request->has('foto_rumah')) {
                $foto_rumah = basename($request->file('foto_rumah')->store('public/foto_rumah'));
            }

            $penyandang->nama = $request->nama;
            $penyandang->no_induk_disabilitas = $request->no_induk_disabilitas;
            $penyandang->nik = $request->nik;
            $penyandang->no_kk = $request->no_kk;
            $penyandang->jenis_kelamin = $request->jenis_kelamin;
            $penyandang->masa_pendidikan = $request->masa_pendidikan;
            $penyandang->pendidikan_terakhir = $request->pendidikan_terakhir;
            $penyandang->status_pernikahan = $request->status_pernikahan;
            $penyandang->keterampilan = $request->keterampilan;
            $penyandang->usaha = $request->usaha;
            $penyandang->kontak = $request->kontak;
            $penyandang->alamat = $request->alamat;
            $penyandang->district_id = $request->district_id;
            $penyandang->latitude = $request->latitude;
            $penyandang->longitude = $request->longitude;
            $penyandang->jenis_disabilitas = $request->jenis_disabilitas;
            // $penyandang->keterangan_meninggal = $request->keterangan_meninggal;
            // $penyandang->keterangan_sembuh = $request->keterangan_sembuh;
            $penyandang->keterangan = $request->keterangan;
            $penyandang->foto_diri = $foto_diri ?? $penyandang->foto_diri;
            $penyandang->foto_ktp = $foto_ktp ?? $penyandang->foto_ktp;
            $penyandang->foto_kk = $foto_kk ?? $penyandang->foto_kk;
            $penyandang->foto_usaha = $foto_usaha ?? $penyandang->foto_usaha;
            $penyandang->foto_rumah = $foto_rumah ?? $penyandang->foto_rumah;

            $penyandang->save();

            return redirect()->route("dashboard.master.penyandang.index")->with('success', 'Data berhasil diedit.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(Penyandang $penyandang)
    {
        try {
            $penyandang->delete();

            return redirect()->route('dashboard.master.penyandang.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
