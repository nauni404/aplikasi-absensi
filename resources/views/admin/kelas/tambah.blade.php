@extends('layouts.admin.app', ['title' => 'Data Kelas'])

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/admin/kelas/{{ $kelas_id }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Siswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('kelas.index') }}">Kelas</a></div>
                <div class="breadcrumb-item">Tambah Siswa</div>
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
                        <h4>Data Siswa</h4>
                        @if (count($siswa) > 0)
                            <div class="card-header-action">
                                <a href="/admin/kelas/create" class="btn btn-primary">Tambah Siswa</a>
                            </div>
                        @else
                        @endif
                    </div>
                    @if (count($siswa) > 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $sis)
                                            @if (!$sis->kelas_id)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $sis->nis }}</td>
                                                    <td class="text-center">{{ $sis->nama }}</td>
                                                    <td class="text-center">{{ $sis->jk }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-primary btn-action" data-toggle="tooltip"
                                                            title="Tambah"
                                                            data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                            data-confirm-yes="tambahSiswa({{ $sis->id }}, {{ $kelas_id }})">
                                                            <i class="fas fa-user-plus"></i>
                                                        </a>
                                                        <form id="tambahForm-{{ $sis->id }}" method="POST">
                                                            @method('put')
                                                            @csrf
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
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
                                <h2>Tidak ada siswa untuk di masukan kedalam kelas ini</h2>
                                <p class="lead">
                                    Untuk menghilangkan pesan ini, buat setidaknya 1 siswa.
                                </p>
                                <a href="/admin/siswa/create" class="btn btn-primary mt-4">Tambah Siswa</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function tambahSiswa(siswaId, kelasId) {
            // Mengambil referensi formulir dengan menggunakan ID yang unik
            var form = document.getElementById('tambahForm-' + siswaId);

            // Mengatur atribut action pada formulir
            form.action = "siswa/" + siswaId + "/tambah-ke-kelas/" + kelasId;
            // form.action = "kelas/" + kelasId + "/tambah-siswa/" + siswaId + ;
            // Misalkan URL berisi parameter siswa ID dan kelas ID

            // Melakukan submit formulir
            form.submit();
        }
    </script>
@endsection
