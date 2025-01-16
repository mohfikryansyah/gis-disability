<?php

namespace App\Http\Controllers\Exports;

use App\Models\Relawan;
use App\Models\District;
use Illuminate\Http\Request;
use App\Exports\PenyandangExport;
use App\Http\Controllers\Controller;
use App\Models\Penyandang;
use Maatwebsite\Excel\Facades\Excel;

class RelawanExportController extends Controller
{
    public function ExportPenyandang(Request $request) {
        
        if (auth()->user()->isRelawan()) {
            $district = District::where('id', auth()->user()->relawan->district_id)->pluck('id')->firstOrFail();
            $id = $request->penyandang_id;
            return Excel::download(new PenyandangExport($id, $district), 'penyandang.xlsx');
        } else {
            $district = $request->district_id;
            $id = $request->penyandang_id;
            return Excel::download(new PenyandangExport($id, $district), 'penyandang.xlsx');
        }
    }
}
