@extends('layouts.admin.app', ['title' => 'Data Rekap'])

@section('content')
    <h1>Rekapitulasi Absensi Siswa</h1>
    <h3>Rekapitulasi Per {{ ucfirst($rekap) }}</h3>

    @if ($rekap === 'hari')
        <h4>{{ $tanggal }} - Kelas {{ $kelas->tingkat_kelas . ' ' . $kelas->jurusan . ' ' . $kelas->nama }}</h4>
        <h5>Guru: {{ $jadwal->guru->nama }}</h5>
        <h5>Mata Pelajaran: {{ $jadwal->mapel->nama }}</h5>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Status Absensi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach ($rekapData as $tanggal => $data)
                    @foreach ($data as $namaSiswa => $status)
                        @foreach ($status as $nisSiswa => $absenStatus)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $nisSiswa }}</td>
                                <td>{{ $namaSiswa }}</td>
                                <td>{{ $tanggal }}</td>
                                <td>{{ $absenStatus }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @elseif ($rekap === 'minggu')
        <h4>{{ $minggu }} - Kelas {{ $kelas->tingkat_kelas . ' ' . $kelas->jurusan . ' ' . $kelas->nama }}</h4>
        <h5>Guru: {{ $jadwal->guru->nama }}</h5>
        <h5>Mata Pelajaran: {{ $jadwal->mapel->nama }}</h5>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Status Absensi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach ($rekapData as $tanggal => $data)
                    @foreach ($data as $namaSiswa => $status)
                        @foreach ($status as $nisSiswa => $absenStatus)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $nisSiswa }}</td>
                                <td>{{ $namaSiswa }}</td>
                                <td>{{ $tanggal }}</td>
                                <td>{{ $absenStatus }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @elseif ($rekap === 'bulan')
        <h4>{{ $bulan }} - Kelas {{ $kelas->tingkat_kelas . ' ' . $kelas->jurusan . ' ' . $kelas->nama }}</h4>
        <h5>Guru: {{ $jadwal->guru->nama }}</h5>
        <h5>Mata Pelajaran: {{ $jadwal->mapel->nama }}</h5>

        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" rowspan="2">No</th>
                    <th class="text-center" rowspan="2">NIS</th>
                    <th class="text-center" rowspan="2">Nama</th>
                    <th class="text-center" colspan="{{ count($tanggalList) }}">Tanggal</th>
                    <th class="text-center" colspan="4">Jumlah</th>
                </tr>
                <tr>
                    @foreach ($tanggalList as $tanggal)
                        <th>{{ $tanggal }}</th>
                    @endforeach
                    <th class="text-center">Alpha</th>
                    <th class="text-center">Sakit</th>
                    <th class="text-center">Izin</th>
                    <th class="text-center">Hadir</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                {{-- @foreach ($rekapData as $bulan => $data)
                    @foreach ($data as $namaSiswa => $status)
                        @foreach ($status as $nisSiswa => $absenStatus)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $nisSiswa }}</td>
                                <td class="text-center">{{ $namaSiswa }}</td>
                                @foreach ($tanggalList as $tanggal)
                                    <td class="text-center">{{ isset($data[$tanggal]) ? $data[$tanggal] : '-' }}</td>
                                @endforeach
                                <td class="text-center">{{ is_array($absenStatus) ? $absenStatus['alpha'] : 0 }}</td>
                                <td class="text-center">{{ is_array($absenStatus) ? $absenStatus['sakit'] : 0 }}</td>
                                <td class="text-center">{{ is_array($absenStatus) ? $absenStatus['izin'] : 0 }}</td>
                                <td class="text-center">{{ is_array($absenStatus) ? $absenStatus['hadir'] : 0 }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach --}}
                @foreach ($rekapData as $siswaData)
                    @foreach ($siswaData as $nisSiswa => $tanggalData)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $nisSiswa }}</td>
                            <td class="text-center">{{ $nisSiswa }}</td>
                            @foreach ($tanggalList as $tanggal)
                                <td class="text-center">{{ isset($tanggalData[$tanggal]) ? $tanggalData[$tanggal] : '-' }}
                                </td>
                            @endforeach
                            <td class="text-center">{{ isset($tanggalData['alpha']) ? $tanggalData['alpha'] : 0 }}</td>
                            <td class="text-center">{{ isset($tanggalData['sakit']) ? $tanggalData['sakit'] : 0 }}</td>
                            <td class="text-center">{{ isset($tanggalData['izin']) ? $tanggalData['izin'] : 0 }}</td>
                            <td class="text-center">{{ isset($tanggalData['hadir']) ? $tanggalData['hadir'] : 0 }}</td>
                        </tr>
                    @endforeach
                @endforeach

            </tbody>
        </table>
    @else
        <p>Tidak ada data untuk ditampilkan.</p>
    @endif
@endsection
