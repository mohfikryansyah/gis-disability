<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Relawan;
use App\Models\Activity;
use App\Models\District;
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
        $gallery = [
            'gambar (1).webp',
            'gambar (2).webp',
            'gambar (3).webp',
            'gambar (4).webp',
            'gambar (5).webp',
            'gambar (6).webp',
            'gambar (7).webp',
            'gambar (8).png',
        ];
        
        return view('landing-page', [
            'penyandang' => $penyandang,
            'relawan' => $relawan,
            'bantuan' => $bantuan,
            'districts' => $districts,
            'kegiatans' => $kegiatan,
            'galleries' => $gallery
        ]);
    }
}
