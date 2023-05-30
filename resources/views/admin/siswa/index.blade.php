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
                        <div class="card-header-action">
                            <a href="/admin/siswa/create" class="btn btn-primary">Tambah Siswa</a>
                        </div>
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
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
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
                </div>
                {{ $siswa->links() }}
            </div>
        </div>
    </section>
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
