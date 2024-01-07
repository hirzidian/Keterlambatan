<?php

namespace App\Exports;

use App\Models\Lates; // Pastikan ini sesuai dengan nama model yang digunakan
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LatesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
   public function collection()
    {
        return Lates::with('student')
        ->orderBy('created_at', 'desc') // Menyortir berdasarkan tanggal terbaru
        ->get()
        ->groupBy('student_id')
        ->map(function ($group) {
            $lates = $group->first(); // Mengambil data terbaru untuk setiap siswa
            return [
                $lates->student->nis,
                $lates->student->name,
                $lates->student->rombel_id ,
                $lates->student->rayon_id ,
                $group->count()
            ];
        });
    }

    public function headings(): array {
        return [
            'NIS', 'Nama', 'Rombel', 'Rayon', 'Jumlah Keterlambatan'
        ];
    }
}