<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Relawan;
use App\Models\Activity;
use App\Models\District;
use App\Models\Gallery;
use App\Models\PengaturanAplikasi;
use App\Models\Penyandang;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $penyandang = Penyandang::get();
        $relawan = Relawan::get();
        $bantuan = Bantuan::get();
        $districts = District::with('relawan', 'penyandang')->get();
        $kegiatan = Activity::with(['documentations', 'relawan'])->take(4)->latest()->get();
        $gallery = Gallery::take(6)->latest()->get();
        $pengaturanAplikasi = PengaturanAplikasi::first();
        
        return view('landing-page', [
            'penyandang' => $penyandang,
            'relawan' => $relawan,
            'bantuan' => $bantuan,
            'districts' => $districts,
            'kegiatans' => $kegiatan,
            'galleries' => $gallery,
            'pengaturanAplikasi' => $pengaturanAplikasi,
        ]);
    }
}
