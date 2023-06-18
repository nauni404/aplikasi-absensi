{{-- @dd($jadwalSiswa); --}}
@extends('layouts.siswa.app', ['title' => 'Dashboard'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        {{-- Jadwal --}}
        <div class="row">
            {{-- Jadwal Hari ini --}}
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Jadwal Hari Ini</h4>
                    </div>
                    @if (count($jadwalHariIni) > 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Hari</th>
                                            <th class="text-center">Guru</th>
                                            <th class="text-center">Mata Pelajaran</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalHariIni as $jadwal)
                                            @php
                                                $absensi = $absensi->firstWhere('jadwal_id', $jadwal->id);
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $jadwal->hari }}</td>
                                                <td class="text-center">{{ $jadwal->guru->nama }}</td>
                                                <td class="text-center">{{ $jadwal->mapel->nama }}</td>
                                                <td class="text-center">
                                                    @if ($absensi)
                                                        {{ $absensi->status }}
                                                    @else
                                                        -
                                                    @endif
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
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Semua Jadwal Mengajar</h4>
                    </div>
                    @if (count($jadwalSiswa) > 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0" style="padding: 0 0px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Jadwal</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Mata Pelajaran</th>
                                            <th class="text-center">Guru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalSiswa as $jadwal)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    {{ $jadwal->hari . ' | ' . substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $jadwal->kelas->tingkat_kelas . ' ' . $jadwal->kelas->jurusan . ' ' . $jadwal->kelas->nama }}
                                                </td>
                                                <td class="text-center">{{ $jadwal->mapel->nama }}</td>
                                                <td class="text-center">{{ $jadwal->guru->nama }}</td>
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
