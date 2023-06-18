<!DOCTYPE html>
<html>

<head>
    <title>Rekap Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        th:first-child {
            width: 30px;
        }

        .small-column {
            width: 30px;
        }

        h3 {
            margin-bottom: 10px;
        }

        p {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <h3>Rekap Absensi Siswa</h3>
    <h3>Kelas: {{ $kelas->tingkat_kelas . ' ' . $kelas->jurusan . ' ' . $kelas->nama }}</h3>
    <h3>Guru: {{ count($absensi) > 0 ? $absensi[0]->jadwal->guru->nama : 'Tidak ada data guru' }}</h3>
    <h3>Mata Pelajaran: {{ count($absensi) > 0 ? $absensi[0]->jadwal->mapel->nama : 'Tidak ada data mapel' }}</h3>
    {{-- <h3>Rekapitulasi: {{ ucfirst($rekap) }}</h3> --}}

    @if ($rekap == 'hari')
        <h3>Tanggal: {{ now('Asia/Jakarta')->format('d-m-Y') }}</h3>
        <hr><br>
        @if (count($absensi) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Siswa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensi as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->siswa->nis }}</td>
                            <td>{{ $data->siswa->nama }}</td>
                            <td>{{ $data->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>Tidak ada data absensi yang ditemukan</h3>
            <p>Tidak ada data absensi yang sesuai dengan kriteria yang dipilih.</p>
        @endif
    @elseif ($rekap == 'minggu')
        <h3>Tanggal: {{ now('Asia/Jakarta')->startOfWeek()->format('d-m-Y') }} -
            {{ now('Asia/Jakarta')->endOfWeek()->format('d-m-Y') }}
        </h3>
        <hr><br>
        @if (count($absensi) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">NIS</th>
                        <th rowspan="2">Siswa</th>
                        <th colspan="4" class="small-column">Jumlah</th>
                    </tr>
                    <tr>
                        <th class="small-column">A</th>
                        <th class="small-column">S</th>
                        <th class="small-column">I</th>
                        <th class="small-column">H</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $siswaData = [];
                    @endphp
                    @foreach ($absensi as $index => $data)
                        @php
                            $siswaId = $data->siswa->id;
                            if (!isset($siswaData[$siswaId])) {
                                $siswaData[$siswaId] = [
                                    'A' => 0,
                                    'S' => 0,
                                    'I' => 0,
                                    'H' => 0,
                                ];
                            }
                            $siswaData[$siswaId][$data->status]++;
                        @endphp
                    @endforeach
                    @foreach ($siswaData as $siswaId => $statuses)
                        @php
                            $siswa = $absensi->first(function ($item) use ($siswaId) {
                                return $item->siswa->id == $siswaId;
                            });
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->siswa->nis }}</td>
                            <td>{{ $siswa->siswa->nama }}</td>
                            <td>{{ $statuses['A'] }}</td>
                            <td>{{ $statuses['S'] }}</td>
                            <td>{{ $statuses['I'] }}</td>
                            <td>{{ $statuses['H'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>Tidak ada data absensi yang ditemukan</h3>
            <p>Tidak ada data absensi yang sesuai dengan kriteria yang dipilih.</p>
        @endif
    @elseif ($rekap == 'bulan')
        <h3>Tanggal: {{ now('Asia/Jakarta')->startOfMonth()->format('d-m-Y') }} -
            {{ now('Asia/Jakarta')->endOfMonth()->format('d-m-Y') }}
        </h3>
        <hr><br>
        @if (count($absensi) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">NIS</th>
                        <th rowspan="2">Siswa</th>
                        <th colspan="4">Jumlah</th>
                    </tr>
                    <tr>
                        <th class="small-column">A</th>
                        <th class="small-column">S</th>
                        <th class="small-column">I</th>
                        <th class="small-column">H</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $siswaData = [];
                    @endphp
                    @foreach ($absensi as $index => $data)
                        @php
                            $siswaId = $data->siswa->id;
                            if (!isset($siswaData[$siswaId])) {
                                $siswaData[$siswaId] = [
                                    'A' => 0,
                                    'S' => 0,
                                    'I' => 0,
                                    'H' => 0,
                                ];
                            }
                            $siswaData[$siswaId][$data->status]++;
                        @endphp
                    @endforeach
                    @foreach ($siswaData as $siswaId => $statuses)
                        @php
                            $siswa = $absensi->first(function ($item) use ($siswaId) {
                                return $item->siswa->id == $siswaId;
                            });
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->siswa->nis }}</td>
                            <td>{{ $siswa->siswa->nama }}</td>
                            <td>{{ $statuses['A'] }}</td>
                            <td>{{ $statuses['S'] }}</td>
                            <td>{{ $statuses['I'] }}</td>
                            <td>{{ $statuses['H'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>Tidak ada data absensi yang ditemukan</h3>
            <p>Tidak ada data absensi yang sesuai dengan kriteria yang dipilih.</p>
        @endif
    @elseif ($rekap == 'custom')
        <h3>Periode: {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} -
            {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</h3>
        @if (count($absensi) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">NIS</th>
                        <th rowspan="2">Siswa</th>
                        <th colspan="4">Jumlah</th>
                    </tr>
                    <tr>
                        <th class="small-column">A</th>
                        <th class="small-column">S</th>
                        <th class="small-column">I</th>
                        <th class="small-column">H</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $siswaData = [];
                    @endphp
                    @foreach ($absensi as $index => $data)
                        @php
                            $siswaId = $data->siswa->id;
                            if (!isset($siswaData[$siswaId])) {
                                $siswaData[$siswaId] = [
                                    'A' => 0,
                                    'S' => 0,
                                    'I' => 0,
                                    'H' => 0,
                                ];
                            }
                            $siswaData[$siswaId][$data->status]++;
                        @endphp
                    @endforeach
                    @foreach ($siswaData as $siswaId => $statuses)
                        @php
                            $siswa = $absensi->first(function ($item) use ($siswaId) {
                                return $item->siswa->id == $siswaId;
                            });
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->siswa->nis }}</td>
                            <td>{{ $siswa->siswa->nama }}</td>
                            <td>{{ $statuses['A'] }}</td>
                            <td>{{ $statuses['S'] }}</td>
                            <td>{{ $statuses['I'] }}</td>
                            <td>{{ $statuses['H'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>Tidak ada data absensi yang ditemukan</h3>
            <p>Tidak ada data absensi yang sesuai dengan kriteria yang dipilih.</p>
        @endif
    @endif
</body>

</html>
