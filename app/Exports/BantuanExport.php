<?php

namespace App\Exports;

use App\Models\Bantuan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BantuanExport implements FromQuery, WithHeadings, WithMapping
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
        $query = Bantuan::query();

        if ($this->id) {
            $query->where('penyandang_id', $this->id);
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
            'Nama Penyandang',
            'Status',
            'Jenis Bantuan',
            'Detail Bantuan',
            'Nama Relawan',
        ];
        
    }

    // Map data for each row
    public function map($row): array
    {
        return [
            $row->penyandang->nama ?? '',
            $row->status,
            $row->jenis,
            $row->detail,
            $row->relawan->user->name ?? '',
        ];
    }
}
