<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapAbsensiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle
{
    protected $data;
    protected $kelas;
    protected $guru;
    protected $mapel;
    protected $absensi;
    protected $rekap;
    protected $start_date;
    protected $end_date;

    public function __construct($data, $kelas, $guru, $mapel, $absensi, $rekap, $start_date, $end_date)
    {
        $this->data = $data;
        $this->kelas = $kelas;
        $this->guru = $guru;
        $this->mapel = $mapel;
        $this->absensi = $absensi;
        $this->rekap = $rekap;
        $this->start_date = $start_date;
        $this->end_date = $end_date;

    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        $kelas = $this->kelas;
        $guru = $this->guru ? $this->guru->nama : 'Tidak ada data guru';
        $mapel = $this->mapel ? $this->mapel->nama : 'Tidak ada data mapel';
        $rekap = ucfirst($this->rekap);
        $start_date = $this->start_date;
        $end_date = $this->end_date;

        $title = [
            ['Kelas:', $kelas->tingkat_kelas . ' ' . $kelas->jurusan . ' ' . $kelas->nama],
            ['Guru:', $guru],
            ['Mata Pelajaran:', $mapel],
            ['Rekapitulasi:', $rekap],
            ['Tanggal:', $start_date . ' - ' . $end_date],
            [''], // Empty row
            [
                'No.',
                'NIS',
                'Siswa',
                'A',
                'S',
                'I',
                'H',
            ],
        ];

        return $title;
    }

    public function title(): string
    {
        $kelas = $this->kelas;
        $absensi = $this->absensi;
        $start_date = $this->start_date;
        $end_date = $this->end_date;

        $title = 'Kelas: ' . $kelas->tingkat_kelas . ' ' . $kelas->jurusan . ' ' . $kelas->nama . "\n";
        $title .= 'Guru: ' . ($this->guru ? $this->guru->nama : 'Tidak ada data guru') . "\n";
        $title .= 'Mata Pelajaran: ' . ($this->mapel ? $this->mapel->nama : 'Tidak ada data mapel') . "\n";
        $title .= 'Rekapitulasi: ' . ucfirst($this->rekap);
        $title .= 'Tanggal: ' . $start_date . ' - ' . $end_date;

        return $title;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:B5')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('A7:G' . ($sheet->getHighestRow()))->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'horizontal' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                    'borderColor' => ['rgb' => '000000'],
                ],
                'vertical' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                    'borderColor' => ['rgb' => '000000'],
                ],
            ],
        ]);

        return [
            7 => [
                'font' => ['bold' => true],
            ],
        ];
    }

}
