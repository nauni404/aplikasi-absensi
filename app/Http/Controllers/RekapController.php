<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\RekapAbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $jadwal = Jadwal::all();

        return view('admin.rekap.index', compact('kelas', 'jadwal'));
    }

    public function viewRekap(Request $request)
    {
        $kelas = Kelas::findOrFail($request->kelas_id);
        $rekap = $request->rekap;

        // Query untuk mendapatkan data absensi berdasarkan jadwal dan kelas yang dipilih
        $absensi = Absensi::where('kelas_id', $request->kelas_id)
            ->where('jadwal_id', $request->jadwal_id);

        // Filter berdasarkan rekapitulasi yang dipilih
        if ($rekap == 'hari') {
            // Rekap hari ini
            $startDate = now()->format('Y-m-d');
            $endDate = now()->format('Y-m-d');
            $absensi = $absensi->where('tanggal', now()->format('Y-m-d'));
        } elseif ($rekap == 'minggu') {
            // Rekap minggu ini (7 hari terakhir)
            $startDate = now()->startOfWeek()->format('Y-m-d');
            $endDate = now()->endOfWeek()->format('Y-m-d');
            $absensi = $absensi->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($rekap == 'bulan') {
            // Rekap bulan ini
            $startDate = now()->startOfMonth()->format('Y-m-d');
            $endDate = now()->endOfMonth()->format('Y-m-d');
            $absensi = $absensi->whereYear('tanggal', now()->year)
                ->whereMonth('tanggal', now()->month);
        } elseif ($rekap == 'custom') {
            // Rekap rentang tanggal yang disesuaikan
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            $absensi = $absensi->whereBetween('tanggal', [$startDate, $endDate]);
        }

        $absensi = $absensi->get();

        // Mendapatkan tipe rekap yang dipilih
        $rekapType = ucfirst($rekap);

        // Generate nama file berdasarkan tipe rekap
        $fileName = 'Rekap_Absensi_' . $kelas->nama . '_' . $rekapType . '_' . date('YmdHis');

        // Generate URL untuk mengunduh rekap dalam format PDF
        $pdfUrl = route('rekap.download', ['rekap' => $rekap, 'kelas_id' => $request->kelas_id, 'jadwal_id' => $request->jadwal_id, 'start_date' => $startDate, 'end_date' => $endDate, 'format' => 'pdf']);

        // Generate URL untuk mengunduh rekap dalam format Excel
        $excelUrl = route('rekap.download', ['rekap' => $rekap, 'kelas_id' => $request->kelas_id, 'jadwal_id' => $request->jadwal_id, 'start_date' => $startDate, 'end_date' => $endDate, 'format' => 'excel']);

        // Tambahkan pengecekan dan penugasan variabel $start_date dan $end_date
        if ($rekap == 'custom') {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        } elseif ($rekap == 'hari') {
            // Atur nilai $start_date dan $end_date berdasarkan rekap 'hari'
            $start_date = now()->format('Y-m-d');
            $end_date = now()->format('Y-m-d');
        } elseif ($rekap == 'minggu') {
            // Atur nilai $start_date dan $end_date berdasarkan rekap 'minggu'
            $start_date = now()->startOfWeek()->format('Y-m-d');
            $end_date = now()->endOfWeek()->format('Y-m-d');
        } elseif ($rekap == 'bulan') {
            // Atur nilai $start_date dan $end_date berdasarkan rekap 'bulan'
            $start_date = now()->startOfMonth()->format('Y-m-d');
            $end_date = now()->endOfMonth()->format('Y-m-d');
        }

        return view('admin.rekap.view', compact('kelas', 'rekap', 'absensi', 'pdfUrl', 'excelUrl', 'fileName', 'start_date', 'end_date'));
    }

    public function download($rekap, $kelas_id, $jadwal_id, $start_date, $end_date, $format)
    {
        $kelas = Kelas::findOrFail($kelas_id);

        // Query dan filter absensi berdasarkan rekapitulasi yang dipilih
        $absensi = Absensi::where('kelas_id', $kelas_id)
            ->where('jadwal_id', $jadwal_id);

        if ($rekap == 'hari') {
            $absensi = $absensi->where('tanggal', now()->format('Y-m-d'));
        } elseif ($rekap == 'minggu') {
            $absensi = $absensi->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($rekap == 'bulan') {
            $absensi = $absensi->whereYear('tanggal', now()->year)
                ->whereMonth('tanggal', now()->month);
        } elseif ($rekap == 'custom') {
            // Rekap rentang tanggal yang disesuaikan
            $absensi = $absensi->whereBetween('tanggal', [$start_date, $end_date]);
        }

        $absensi = $absensi->get();

        // Generate nama file
        $fileName = 'Rekap_Absensi_' . $kelas->tingkat_kelas . '_' . $kelas->jurusan . '_' . $kelas->nama . '_' . date('d-m-Y');
        if ($format == 'pdf') {
            // Menggunakan library DomPDF untuk menghasilkan file PDF

            // Render view rekapitulasi absensi ke dalam HTML
            $view = view('admin.rekap.pdf', compact('kelas', 'rekap', 'absensi', 'start_date', 'end_date'))->render();

            // Membuat PDF dengan menggunakan DomPDF
            $pdf = PDF::loadHTML($view);

            // Mengunduh file PDF
            return $pdf->download($fileName . '.pdf');
        } elseif ($format == 'excel') {
            $guru = count($absensi) > 0 ? $absensi[0]->jadwal->guru : null;
            $mapel = count($absensi) > 0 ? $absensi[0]->jadwal->mapel : null;
            $data = [];
            $siswaData = [];
            $no = 1;
            foreach ($absensi as $index => $dataAbsensi) {
                $siswaId = $dataAbsensi->siswa->id;

                // Inisialisasi data siswa jika belum ada
                if (!isset($siswaData[$siswaId])) {
                    $siswaData[$siswaId] = [
                        'A' => 0,
                        'S' => 0,
                        'I' => 0,
                        'H' => 0,
                    ];
                }

                // Increment status count for the current student
                $siswaData[$siswaId][$dataAbsensi->status]++;
            }

            foreach ($siswaData as $siswaId => $statuses) {
                $siswa = $absensi->first(function ($item) use ($siswaId) {
                    return $item->siswa->id == $siswaId;
                });

                $data[] = [
                    'No' => $no++,
                    'NIS' => $siswa->siswa->nis,
                    'Siswa' => $siswa->siswa->nama,
                    'A' => $statuses['A'],
                    'S' => $statuses['S'],
                    'I' => $statuses['I'],
                    'H' => $statuses['H'],
                ];
            }

            // Generate the Excel file
            return Excel::download(
                new RekapAbsensiExport($data, $kelas, $guru, $mapel, $absensi, $rekap, $start_date, $end_date),
                $fileName . '.xlsx'
            );
        }
    }

    public function indexGuru()
    {
        $guruId = auth()->user()->guru->id;

        // Mengambil kelas dengan jadwal yang dimiliki oleh guru yang sedang login
        $kelas = Kelas::whereHas('jadwal', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })->get();

        // Mengambil jadwal dari guru yang sedang login
        $jadwal = Jadwal::where('guru_id', $guruId)->get();
        return view('guru.rekap.index', compact('kelas', 'jadwal'));
    }

    public function viewRekapGuru(Request $request)
    {
        $kelas = Kelas::findOrFail($request->kelas_id);
        $rekap = $request->rekap;

        // Query untuk mendapatkan data absensi berdasarkan jadwal dan kelas yang dipilih
        $absensi = Absensi::where('kelas_id', $request->kelas_id)
            ->where('jadwal_id', $request->jadwal_id);

        // Filter berdasarkan rekapitulasi yang dipilih
        if ($rekap == 'hari') {
            // Rekap hari ini
            $startDate = now()->format('Y-m-d');
            $endDate = now()->format('Y-m-d');
            $absensi = $absensi->where('tanggal', now()->format('Y-m-d'));
        } elseif ($rekap == 'minggu') {
            // Rekap minggu ini (7 hari terakhir)
            $startDate = now()->startOfWeek()->format('Y-m-d');
            $endDate = now()->endOfWeek()->format('Y-m-d');
            $absensi = $absensi->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($rekap == 'bulan') {
            // Rekap bulan ini
            $startDate = now()->startOfMonth()->format('Y-m-d');
            $endDate = now()->endOfMonth()->format('Y-m-d');
            $absensi = $absensi->whereYear('tanggal', now()->year)
                ->whereMonth('tanggal', now()->month);
        } elseif ($rekap == 'custom') {
            // Rekap rentang tanggal yang disesuaikan
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            $absensi = $absensi->whereBetween('tanggal', [$startDate, $endDate]);
        }

        $absensi = $absensi->get();

        // Mendapatkan tipe rekap yang dipilih
        $rekapType = ucfirst($rekap);

        // Generate nama file berdasarkan tipe rekap
        $fileName = 'Rekap_Absensi_' . $kelas->nama . '_' . $rekapType . '_' . date('YmdHis');

        // Generate URL untuk mengunduh rekap dalam format PDF
        $pdfUrl = route('guru.rekap.download', ['rekap' => $rekap, 'kelas_id' => $request->kelas_id, 'jadwal_id' => $request->jadwal_id, 'start_date' => $startDate, 'end_date' => $endDate, 'format' => 'pdf']);

        // Generate URL untuk mengunduh rekap dalam format Excel
        $excelUrl = route('guru.rekap.download', ['rekap' => $rekap, 'kelas_id' => $request->kelas_id, 'jadwal_id' => $request->jadwal_id, 'start_date' => $startDate, 'end_date' => $endDate, 'format' => 'excel']);

        // Tambahkan pengecekan dan penugasan variabel $start_date dan $end_date
        if ($rekap == 'custom') {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        } elseif ($rekap == 'hari') {
            // Atur nilai $start_date dan $end_date berdasarkan rekap 'hari'
            $start_date = now()->format('Y-m-d');
            $end_date = now()->format('Y-m-d');
        } elseif ($rekap == 'minggu') {
            // Atur nilai $start_date dan $end_date berdasarkan rekap 'minggu'
            $start_date = now()->startOfWeek()->format('Y-m-d');
            $end_date = now()->endOfWeek()->format('Y-m-d');
        } elseif ($rekap == 'bulan') {
            // Atur nilai $start_date dan $end_date berdasarkan rekap 'bulan'
            $start_date = now()->startOfMonth()->format('Y-m-d');
            $end_date = now()->endOfMonth()->format('Y-m-d');
        }

        return view('guru.rekap.view', compact('kelas', 'rekap', 'absensi', 'pdfUrl', 'excelUrl', 'fileName', 'start_date', 'end_date'));
    }
}
