{{-- @dd($jadwalGuru); --}}
@extends('layouts.guru.app', ['title' => 'Dashboard'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        {{-- Total Akun --}}
        <div class="row">
            {{-- Siswa --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Mengajar</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalSiswa }} siswa
                        </div>
                    </div>
                </div>
            </div>
            {{-- Kelas --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Mengajar</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalKelas }} kelas
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Jadwal --}}
        <div class="row">
            {{-- Jadwal Hari ini --}}
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Jadwal Mengajar Hari Ini</h4>
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
                                                    {{ $jadwal->absensi->where('status')->where('tanggal', \Carbon\Carbon::now('Asia/Jakarta')->toDateString())->count() }}
                                                    /
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
                            <div class="empty-state" data-height="">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>Tidak ada jadwal mengajar hari ini</h2>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- Semua Jadwal --}}
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Semua Jadwal Mengajar</h4>
                    </div>
                    @if (count($jadwalGuru) > 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0" style="padding: 0 0px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Jadwal</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Mata Pelajaran</th>
                                            <th class="text-center">Jumlah Siswa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalGuru as $jadwal)
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
                                                    {{ $jadwal->kelas->siswa->count() }}
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
            </div>
        </div>
    </section>
@endsection
