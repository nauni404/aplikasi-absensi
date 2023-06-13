@extends('layouts.admin.app', ['title' => 'Data Jadwal'])

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
                        <h4>Data Jadwal</h4>
                        @if (count($jadwals) > 0)
                            <div class="card-header-action">
                                <a href="/admin/jadwal/create" class="btn btn-primary">Tambah Jadwal</a>
                            </div>
                        @endif
                    </div>
                    @if (count($jadwals) > 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Guru</th>
                                            <th class="text-center">Mata Pelajaran</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Hari</th>
                                            <th class="text-center">Jam</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwals as $jadwal)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $jadwal->guru->nama }}</td>
                                                <td class="text-center">{{ $jadwal->mapel->nama }}</td>
                                                <td class="text-center">
                                                    {{ $jadwal->kelas->tingkat_kelas . ' ' . $jadwal->kelas->jurusan . ' ' . $jadwal->kelas->nama }}
                                                </td>
                                                <td class="text-center">{{ $jadwal->hari }}</td>
                                                <td class="text-center">
                                                    {{ $jadwal->jam_mulai . ' - ' . $jadwal->jam_selesai }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                        title="Edit" href="/admin/jadwal/{{ $jadwal->id }}/edit">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-action" data-toggle="tooltip"
                                                        title="Delete"
                                                        data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                        data-confirm-yes="deleteJadwal({{ $jadwal->id }})"><i
                                                            class="fas fa-trash"></i> </a>
                                                    <form id="deleteForm-{{ $jadwal->id }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
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
                                <h2>Tidak ada jadwal yang terdaftar</h2>
                                <p class="lead">
                                    Untuk menghilangkan pesan ini, buat setidaknya 1 jadwal.
                                </p>
                                <a href="/admin/jadwal/create" class="btn btn-primary mt-4">Tambah Jadwal
                                </a>
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
    <script>
        function deleteJadwal(jadwalId) {
            // Mengambil referensi formulir dengan menggunakan ID yang unik
            var form = document.getElementById('deleteForm-' + jadwalId);

            // Mengatur atribut action pada formulir
            form.action = "jadwal/" + jadwalId; // Misalkan URL delete berisi parameter jadwal ID

            // Melakukan submit formulir
            form.submit();
        }
    </script>
@endsection
