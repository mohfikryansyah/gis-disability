<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\District;
use App\Models\Penyandang;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBantuanRequest;
use App\Http\Requests\UpdateBantuanRequest;
use App\Http\Requests\ReceiveBantuanRequest;

class BantuanController extends Controller
{
    public function index()
    {
        $query = Bantuan::query();

        if (auth()->user()->isRelawan()) {
            $districtId = auth()->user()->relawan->district_id;
            $query->whereHas('penyandang', function ($query) use ($districtId) {
                $query->where('district_id', $districtId);
            });
        }

        $bantuan = $query->with('penyandang')->get();

        $penyandang = Penyandang::orderBy('nama', 'asc')->get();

        $districts = District::all();

        return view('pages.dashboard.bantuan.index', compact('bantuan', 'penyandang', 'districts'));
    }

    public function create()
    {
        if (!auth()->user()->isRelawan()) {
            return redirect()->back()->withErrors('Akses tidak sah.');
        }

        $query = Penyandang::query();
        $query->where('district_id', auth()->user()->relawan->district_id);

        $penyandang = $query->get();

        return view('pages.dashboard.bantuan.create', compact('penyandang'));
    }

    public function store(StoreBantuanRequest $request)
    {
        try {
            $data = $request->only([
                'penyandang_id',
                'jenis',
                'detail',
                'tanggal'
            ]) + [
                'relawan_id' => auth()->user()->relawan?->id
            ];

            if ($request->hasFile('bukti')) {
                $data['bukti'] = basename($request->file('bukti')->store('public/bukti'));
            }

            $bantuan = Bantuan::create($data);
            
            return redirect()->route('dashboard.bantuan.show', $bantuan->uuid)->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }


    public function show(Bantuan $bantuan)
    {
        return view('pages.dashboard.bantuan.show', compact('bantuan'));
    }

    public function edit(Bantuan $bantuan)
    {
        $this->authorize('edit', $bantuan);

        return view('pages.dashboard.bantuan.edit', compact('bantuan'));
    }

    public function update(UpdateBantuanRequest $request, Bantuan $bantuan)
    {
        try {
            $this->authorize('update', $bantuan);

            if ($request->hasFile('bukti')) {
                Storage::delete('public/bukti/' . $bantuan->bukti);
                $bantuan->bukti = basename($request->file('bukti')->store('public/bukti'));
            }

            $bantuan->jenis = $request->jenis;
            $bantuan->detail = $request->detail;
            $bantuan->tanggal = $request->tanggal;

            $bantuan->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(Bantuan $bantuan)
    {
        try {
            $this->authorize('delete', $bantuan);

            $bantuan->delete();

            return redirect()->route('dashboard.bantuan.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

        public function approve(Bantuan $bantuan)
    {
        try {
            $bantuan->status = 'DISETUJUI';
            $bantuan->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function decline(Bantuan $bantuan)
    {
        try {
            $bantuan->status = 'DITOLAK';
            $bantuan->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function received(ReceiveBantuanRequest $request, Bantuan $bantuan)
    {
        try {
            $bantuan->status = 'DITERIMA';
            $bantuan->bukti = basename($request->file('bukti')->store('public/bukti'));

            $bantuan->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
