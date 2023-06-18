@extends('layouts.admin.app', ['title' => 'Data Mapel'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Mapel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item">Mapel</div>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible show fade col-lg-12 col-md-12 col-12">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Mapel</h4>
                        @if (count($mapels) > 0)
                            <div class="card-header-action">
                                <a href="/admin/mapel/create" class="btn btn-primary">Tambah Mapel</a>
                            </div>
                        @endif
                    </div>
                    @if (count($mapels) > 0)
                        {{-- Search --}}
                        <div class="card-header">
                            @if (request('search'))
                                <div class="section-header-back">
                                    <a href="{{ route('mapel.index') }}" class="btn btn-icon"><i
                                            class="fas fa-arrow-left"></i></a>
                                </div>
                            @endif
                            <form class="card-header-form" action="{{ route('mapel.index') }}">
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
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mapels as $mapel)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $mapel->nama }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                        title="Edit" href="/admin/mapel/{{ $mapel->id }}/edit">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-action" data-toggle="tooltip"
                                                        title="Delete"
                                                        data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                        data-confirm-yes="deleteMapel({{ $mapel->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="deleteForm-{{ $mapel->id }}" method="POST">
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
                                        Data mapel dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                                    </p>
                                    <a href="{{ route('mapel.index') }}" class="btn btn-primary mt-4">Kembali</a>
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2>Tidak ada mapel yang terdaftar</h2>
                                    <p class="lead">
                                        Untuk menghilangkan pesan ini, buat setidaknya 1 mapel.
                                    </p>
                                    <a href="/admin/mapel/create" class="btn btn-primary mt-4">Tambah Mapel</a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                {{ $mapels->links() }}
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function deleteMapel(mapelId) {
            // Mengambil referensi formulir dengan menggunakan ID yang unik
            var form = document.getElementById('deleteForm-' + mapelId);

            // Mengatur atribut action pada formulir
            form.action = "mapel/" + mapelId; // Misalkan URL delete berisi parameter mapel ID

            // Melakukan submit formulir
            form.submit();
        }
    </script>
@endsection
