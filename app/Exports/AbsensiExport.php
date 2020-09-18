<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsensiExport implements FromView, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Status',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $absensi = Absensi::join('karyawans', 'karyawans.user_id', 'absensis.user_id')
        ->join('karyawan_sift', 'karyawan_sift.karyawan_id', 'karyawans.id')
        ->join('sifts', 'karyawan_sift.sift_id', 'sifts.id')
        ->distinct()
        ->get();
        dd($absensi);
        return view('exports.absensi', [
            'absens' => $absensi,
        ]);
    }
}
