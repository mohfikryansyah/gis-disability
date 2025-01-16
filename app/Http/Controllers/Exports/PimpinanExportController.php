<?php

namespace App\Http\Controllers\Exports;

use App\Exports\BantuanExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PimpinanExportController extends Controller
{
    public function ExportBantuan(Request $request) {
        $district = $request->district_id;
        $id = $request->penyandang_id;
        
        return Excel::download(new BantuanExport($id, $district), 'bantuan.xlsx');
    }
}
