@extends('layouts.admin.app', ['title' => 'Data Kelas'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Kelas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item">Kelas</div>
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
                        <h4>Data Kelas</h4>
                        <div class="card-header-action">
                            <a href="/admin/kelas/create" class="btn btn-primary">Tambah Kelas</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $kel)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kel->tingkat_kelas }} {{ $kel->jurusan }} {{ $kel->nama }}</td>
                                            <td>{{ $kel->tahun_masuk }}/{{ $kel->tahun_keluar }}</td>
                                            <td>

                                                <a class="btn btn-info btn-action mr-1" data-toggle="tooltip" title="View"
                                                    href="/admin/kelas/{{ $kel->id }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                    title="Edit" href="/admin/kelas/{{ $kel->id }}/edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="deleteKelas({{ $kel->id }})"><i
                                                        class="fas fa-trash"></i> </a>
                                                <form id="deleteForm-{{ $kel->id }}" method="POST">
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
                </div>
                {{ $kelas->links() }}
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function deleteKelas(kelasId) {
            // Mengambil referensi formulir dengan menggunakan ID yang unik
            var form = document.getElementById('deleteForm-' + kelasId);

            // Mengatur atribut action pada formulir
            form.action = "kelas/" + kelasId; // Misalkan URL delete berisi parameter kelas ID

            // Melakukan submit formulir
            form.submit();
        }
    </script>
@endsection
