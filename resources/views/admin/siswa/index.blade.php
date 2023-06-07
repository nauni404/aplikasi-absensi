@extends('layouts.admin.app', ['title' => 'Data Siswa'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Siswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item">Siswa</div>
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

        <div class="row">
            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Siswa</h4>
                        @if (count($siswa) > 0)
                            <div class="card-header-action">
                                <a href="/admin/siswa/create" class="btn btn-primary">Tambah Siswa</a>
                            </div>
                        @endif
                        <div class="card-header-action">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#importModal">Import Siswa</button>
                        </div>
                    </div>
                    @if (count($siswa) > 0)
                        {{-- Search --}}
                        <div class="card-header">
                            @if (request('search'))
                                <div class="section-header-back">
                                    <a href="{{ route('siswa.index') }}" class="btn btn-icon">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            @endif
                            <form class="card-header-form" action="{{ route('siswa.index') }}">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $sis)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sis->nis }}</td>
                                                <td>{{ $sis->nama }}</td>
                                                <td>{{ $sis->jk }}</td>
                                                <td>

                                                    <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                        title="Edit" href="/admin/siswa/{{ $sis->id }}/edit">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-action" data-toggle="tooltip"
                                                        title="Delete"
                                                        data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                        data-confirm-yes="deleteSiswa({{ $sis->id }})"><i
                                                            class="fas fa-trash"></i> </a>
                                                    <form id="deleteForm-{{ $sis->id }}" method="POST">
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
                        @if (request('search'))
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2>Pencarian tidak ditemukan</h2>
                                    <p class="lead">
                                        Data siswa dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                                    </p>
                                    <a href="{{ route('siswa.index') }}" class="btn btn-primary mt-4">Kembali</a>
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2>Tidak ada siswa yang terdaftar</h2>
                                    <p class="lead">
                                        Untuk menghilangkan pesan ini, buat setidaknya 1 siswa.
                                    </p>
                                    <a href="/admin/siswa/create" class="btn btn-primary mt-4">Tambah Siswa
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                {{ $siswa->links() }}
            </div>
        </div>
    </section>
    {{-- Modal --}}
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" name="file" id="file" required>
                        </div>
                        <p><code>*Catatan</code>
                            <br><code>*</code> Header tidak perlu diubah
                            <br><code>*</code> Pastikan data tidak kosong
                        </p>
                        <div class="form-group">
                            <label>Download Template</label>
                            <a href="{{ asset('excel/template_siswa.xlsx') }}" download>Excel
                                <i class="fas fa-file-excel"></i>
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function deleteSiswa(siswaId) {
            // Mengambil referensi formulir dengan menggunakan ID yang unik
            var form = document.getElementById('deleteForm-' + siswaId);

            // Mengatur atribut action pada formulir
            form.action = "siswa/" + siswaId; // Misalkan URL delete berisi parameter siswa ID

            // Melakukan submit formulir
            form.submit();
        }
    </script>
@endsection
