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
            $absensi = $absensi->where('tanggal', now()->format('Y-m-d'));
        } elseif ($rekap == 'minggu') {
            // Rekap minggu ini (7 hari terakhir)
            $absensi = $absensi->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($rekap == 'bulan') {
            // Rekap bulan ini
            $absensi = $absensi->whereYear('tanggal', now()->year)
                ->whereMonth('tanggal', now()->month);
        }

        $absensi = $absensi->get();

        // Mendapatkan tipe rekap yang dipilih
        $rekapType = ucfirst($rekap);

        // Generate nama file berdasarkan tipe rekap
        $fileName = 'Rekap_Absensi_' . $kelas->nama . '_' . $rekapType . '_' . date('YmdHis');

        // Generate URL untuk mengunduh rekap dalam format PDF
        $pdfUrl = route('rekap.download', ['rekap' => $rekap, 'kelas_id' => $request->kelas_id, 'jadwal_id' => $request->jadwal_id, 'format' => 'pdf']);

        // Generate URL untuk mengunduh rekap dalam format Excel
        $excelUrl = route('rekap.download', ['rekap' => $rekap, 'kelas_id' => $request->kelas_id, 'jadwal_id' => $request->jadwal_id, 'format' => 'excel']);

        return view('admin.rekap.view', compact('kelas', 'rekap', 'absensi', 'pdfUrl', 'excelUrl', 'fileName'));
    }

    public function download($rekap, $kelas_id, $jadwal_id, $format)
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
        }

        $absensi = $absensi->get();

        // Generate nama file
        $fileName = 'Rekap_Absensi_' . $kelas->nama . '_' . ucfirst($rekap) . '_' . date('YmdHis');

        if ($format == 'pdf') {
            // Menggunakan library DomPDF untuk menghasilkan file PDF

            // Render view rekapitulasi absensi ke dalam HTML
            $view = view('admin.rekap.pdf', compact('kelas', 'rekap', 'absensi'))->render();

            // Membuat PDF dengan menggunakan DomPDF
            $pdf = PDF::loadHTML($view);

            // Mengunduh file PDF
            return $pdf->download($fileName . '.pdf');

        } elseif ($format == 'excel') {
            // Mendefinisikan data yang akan ditampilkan dalam file Excel
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
            return Excel::download(new RekapAbsensiExport($data), 'absensi.xlsx');
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
            $absensi = $absensi->where('tanggal', now()->format('Y-m-d'));
        } elseif ($rekap == 'minggu') {
            // Rekap minggu ini (7 hari terakhir)
            $absensi = $absensi->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($rekap == 'bulan') {
            // Rekap bulan ini
            $absensi = $absensi->whereYear('tanggal', now()->year)
                ->whereMonth('tanggal', now()->month);
        }

        $absensi = $absensi->get();

        // Mendapatkan tipe rekap yang dipilih
        $rekapType = ucfirst($rekap);

        // Generate nama file berdasarkan tipe rekap
        $fileName = 'Rekap_Absensi_' . $kelas->nama . '_' . $rekapType . '_' . date('YmdHis');

        // Generate URL untuk mengunduh rekap dalam format PDF
        $pdfUrl = route('guru.rekap.download', ['rekap' => $rekap, 'kelas_id' => $request->kelas_id, 'jadwal_id' => $request->jadwal_id, 'format' => 'pdf']);

        // Generate URL untuk mengunduh rekap dalam format Excel
        $excelUrl = route('guru.rekap.download', ['rekap' => $rekap, 'kelas_id' => $request->kelas_id, 'jadwal_id' => $request->jadwal_id, 'format' => 'excel']);

        return view('guru.rekap.view', compact('kelas', 'rekap', 'absensi', 'pdfUrl', 'excelUrl', 'fileName'));
    }
}
