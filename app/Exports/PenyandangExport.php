<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Penyandang;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class PenyandangExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $id;
    protected $district;

    public function __construct($id = null, $district = null)
    {
        $this->id = $id;
        $this->district = $district;
    }

    public function query()
    {
        $query = Penyandang::query();

        if ($this->id) {
            $query->where('id', $this->id);
        }

        if ($this->district) {
            $query->where('district_id', $this->district);
        }

        $query->orderBy('created_at', 'desc');

        return $query;
    }

    public function headings(): array
    {
        return [
            'No Induk Disabilitas',
            'Nama',
            'Jenis Kelamin',
            'Kontak',
            'NIK',
            'No KK',
            'Alamat',
            'Jenis Disabilitas',
            'Pendidikan Terakhir',
            'Keterampilan',
            'Usaha',
            'Status Pernikahan',
            'Latitude',
            'Longitude',
            'Keterangan Meninggal',
            'Keterangan Sembuh',
            'Kecamatan',
            'Relawan',
        ];
    }

    // Map data for each row
    public function map($row): array
    {
        return [
            $row->no_induk_disabilitas,
            $row->nama,
            $row->jenis_kelamin,
            $row->kontak,
            $row->nik,
            $row->no_kk,
            $row->alamat,
            $row->jenis_disabilitas,
            $row->pendidikan_terakhir,
            $row->keterampilan,
            $row->usaha,
            $row->status_pernikahan,
            $row->latitude,
            $row->longitude,
            $row->keterangan_meninggal,
            $row->keterangan_sembuh,
            $row->district->name,
            $row->relawan->user->name,
        ];
    }
}
