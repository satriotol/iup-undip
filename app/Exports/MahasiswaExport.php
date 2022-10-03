<?php

namespace App\Exports;

use App\Models\UserMahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;

class MahasiswaExport implements FromView, ShouldAutoSize, WithDefaultStyles
{
    public function defaultStyles(Style $defaultStyle)
    {
        return [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ]
        ];
    }
    public function __construct(int $batch)
    {
        $this->batch = $batch;
    }

    public function view(): View
    {
        return view('exports.mahasiswa', [
            'userMahasiswas' => UserMahasiswa::where('batch_id', $this->batch)->get()
        ]);
    }
}
