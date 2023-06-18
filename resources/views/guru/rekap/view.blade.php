@extends('layouts.guru.app', ['title' => 'Rekapitulasi Absensi'])
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('rekap.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tampilan Rekap Absensi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="/rekap">Rekap</a></div>
                <div class="breadcrumb-item">Tampilan Rekap</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Rekap Absensi Siswa</h4>
                @if (count($absensi) > 0)
                    <div class="card-header-action">
                        <a href="{{ route('guru.rekap.download', ['rekap' => $rekap, 'kelas_id' => $kelas->id, 'jadwal_id' => $absensi[0]->jadwal->id, 'format' => 'pdf']) }}"
                            class="btn btn-primary">Download PDF</a>
                    </div>
                    <div class="card-header-action">
                        <a href="{{ route('guru.rekap.download', ['rekap' => $rekap, 'kelas_id' => $kelas->id, 'jadwal_id' => $absensi[0]->jadwal->id, 'format' => 'excel']) }}"
                            class="btn btn-success">Download Excel</a>
                    </div>
                @endif
            </div>
            @if (count($absensi) > 0)
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                            <h6>Kelas: {{ $kelas->tingkat_kelas . ' ' . $kelas->jurusan . ' ' . $kelas->nama }}</h6>
                            <h6>Guru: {{ $absensi[0]->jadwal->guru->nama }}</h6>
                            <h6>Mata Pelajaran: {{ $absensi[0]->jadwal->mapel->nama }}</h6>
                            <h6>Kelas Id: {{ $kelas->id }}</h6>
                            <h6>Jadwal Id: {{ $absensi[0]->jadwal->id }}</h6>
                            <h6>Rekapitulasi: {{ ucfirst($rekap) }}</h6>
                            <hr>
                            @if ($rekap == 'hari')
                                <h6>Tanggal: {{ now('Asia/Jakarta')->format('d-m-Y') }}</h6>
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
                                    <div class="empty-state" data-height="400">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                        <h2>Tidak ada data absensi yang ditemukan</h2>
                                        <p class="lead">Tidak ada data absensi yang sesuai dengan kriteria yang dipilih.
                                        </p>
                                    </div>
                                @endif
                            @elseif ($rekap == 'minggu')
                                <h6>
                                    Periode: {{ now('Asia/Jakarta')->startOfWeek()->format('d-m-Y') }} -
                                    {{ now('Asia/Jakarta')->endOfWeek()->format('d-m-Y') }}
                                </h6>
                                @if (count($absensi) > 0)
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No.</th>
                                                <th rowspan="2">NIS</th>
                                                <th rowspan="2">Siswa</th>
                                                <th colspan="4" class="text-center">Jumlah</th>
                                            </tr>
                                            <tr>
                                                <th>A</th>
                                                <th>S</th>
                                                <th>I</th>
                                                <th>H</th>
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
                                    <div class="empty-state" data-height="400">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                        <h2>Tidak ada data absensi yang ditemukan</h2>
                                        <p class="lead">Tidak ada data absensi yang sesuai dengan kriteria yang dipilih.
                                        </p>
                                    </div>
                                @endif
                            @elseif ($rekap == 'bulan')
                                <h6>Periode: {{ now('Asia/Jakarta')->startOfMonth()->format('d-m-Y') }} -
                                    {{ now('Asia/Jakarta')->endOfMonth()->format('d-m-Y') }}</h6>
                                @if (count($absensi) > 0)
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No.</th>
                                                <th rowspan="2">NIS</th>
                                                <th rowspan="2">Siswa</th>
                                                <th colspan="4" class="text-center">Jumlah</th>
                                            </tr>
                                            <tr>
                                                <th>A</th>
                                                <th>S</th>
                                                <th>I</th>
                                                <th>H</th>
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
                                    <div class="empty-state" data-height="400">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                        <h2>Tidak ada data absensi yang ditemukan</h2>
                                        <p class="lead">Tidak ada data absensi yang sesuai dengan kriteria yang dipilih.
                                        </p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <div class="empty-state" data-height="400">
                        <div class="empty-state-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h2>Tidak ada data absensi yang ditemukan</h2>
                        <p class="lead">Tidak ada data absensi yang sesuai dengan kriteria yang dipilih.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
