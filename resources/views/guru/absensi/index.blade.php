@extends('layouts.guru.app', ['title' => 'Data Jadwal'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Jadwal</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item">Jadwal</div>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible show fade col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible show fade col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Jadwal Absensi Hari Ini</h4>
                    </div>
                    @if (count($jadwalHariIni) > 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Jadwal</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Mata Pelajaran</th>
                                            <th class="text-center">Absen</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalHariIni as $jadwal)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    {{ $jadwal->hari . ' | ' . substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $jadwal->kelas->tingkat_kelas . ' ' . $jadwal->kelas->jurusan . ' ' . $jadwal->kelas->nama }}
                                                </td>
                                                <td class="text-center">{{ $jadwal->mapel->nama }}</td>
                                                <td class="text-center">
                                                    {{ $jadwal->absensi->where('status')->count() }} /
                                                    {{ $jadwal->kelas->siswa->count() }}
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-info btn-action mr-1" data-toggle="tooltip"
                                                        title="View" href="/guru/absensi/{{ $jadwal->kelas->id }}">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>Tidak ada jadwal mengajar hari ini</h2>
                            </div>
                        </div>
                    @endif
                </div>
                {{-- {{ $jadwals->links() }} --}}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Jadwal Absensi Hari Ini</h4>
                    </div>
                    @if (count($jadwalHariIni) > 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Guru</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Kelas</th>
                                            <th>Hari</th>
                                            <th>Jam</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalHariIni as $jadwal)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $jadwal->guru->nama }}</td>
                                                <td class="text-center">{{ $jadwal->mapel->nama }}</td>
                                                <td class="text-center">
                                                    {{ $jadwal->kelas->tingkat_kelas . ' ' . $jadwal->kelas->jurusan . ' ' . $jadwal->kelas->nama }}
                                                </td>
                                                <td class="text-center">{{ $jadwal->hari }}</td>
                                                <td class="text-center">
                                                    {{ substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5) }}
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-info btn-action mr-1" data-toggle="tooltip"
                                                        title="View" href="/guru/absensi/{{ $jadwal->kelas->id }}">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>Tidak ada jadwal mengajar hari ini</h2>
                            </div>
                        </div>
                    @endif
                </div>
                {{-- {{ $jadwals->links() }} --}}
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
