@extends('layouts.admin.app', ['title' => 'Dashboard'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        {{-- Total Akun --}}
        <div class="row">
            {{-- User --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-dark">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>User</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalUsers }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Siswa --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Siswa</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalSiswa }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Guru --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Guru</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalGuru }}
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
                            <h4>Kelas</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalKelas }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Jadwal Guru Hari Ini --}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Jadwal Guru Hari Ini</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jadwal</th>
                                        <th class="text-center">Guru</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Mata Pelajaran</th>
                                        <th class="text-center">Absen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwalHariIni as $jadwal)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                {{ $jadwal->hari . ' | ' . substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5) }}
                                            </td>
                                            <td class="text-center">{{ $jadwal->guru->nama }}</td>
                                            <td class="text-center">
                                                {{ $jadwal->kelas->tingkat_kelas . ' ' . $jadwal->kelas->jurusan . ' ' . $jadwal->kelas->nama }}
                                            </td>
                                            <td class="text-center">{{ $jadwal->mapel->nama }}</td>
                                            <td class="text-center">
                                                {{ $jadwal->absensi->where('status')->where('tanggal', \Carbon\Carbon::now('Asia/Jakarta')->toDateString())->count() }}
                                                /
                                                {{ $jadwal->kelas->siswa->count() }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada jadwal guru hari ini</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
