@extends('layouts.admin.app', ['title' => 'Data Guru'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Guru</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item">Guru</div>
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
                        <h4>Data Guru</h4>
                        <div class="card-header-action">
                            <a href="/admin/guru/create" class="btn btn-primary">Tambah Guru</a>
                        </div>
                    </div>
                    {{-- Search --}}
                    <div class="card-header">
                        @if (request('search'))
                            <div class="section-header-back">
                                <a href="{{ route('guru.index') }}" class="btn btn-icon"><i
                                        class="fas fa-arrow-left"></i></a>
                            </div>
                        @endif
                        <form class="card-header-form" action="{{ route('guru.index') }}">
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
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $gur)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $gur->nip }}</td>
                                            <td>{{ $gur->nama }}</td>
                                            <td>{{ $gur->jk }}</td>
                                            <td>{{ $gur->mapel }}</td>
                                            <td>

                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                    title="Edit" href="/admin/guru/{{ $gur->id }}/edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="deleteGuru({{ $gur->id }})"><i
                                                        class="fas fa-trash"></i> </a>
                                                <form id="deleteForm-{{ $gur->id }}" method="POST">
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
                {{ $guru->links() }}
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function deleteGuru(guruId) {
            // Mengambil referensi formulir dengan menggunakan ID yang unik
            var form = document.getElementById('deleteForm-' + guruId);

            // Mengatur atribut action pada formulir
            form.action = "guru/" + guruId; // Misalkan URL delete berisi parameter guru ID

            // Melakukan submit formulir
            form.submit();
        }
    </script>
@endsection