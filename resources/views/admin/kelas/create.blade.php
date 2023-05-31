@extends('layouts.admin.app', ['title' => 'Tambah Kelas'])

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('kelas.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Kelas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Kelas</a></div>
                <div class="breadcrumb-item">Tambah Kelas</div>
            </div>
        </div>
        <div class="section-body">
            <form method="post" action="/admin/kelas">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Kelas</h4>
                            </div>
                            <div class="card-body">
                                {{-- Tingkat Kelas --}}
                                <div class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tingkat Kelas</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="tingkat_kelas" id="tingkat_kelas" class="form-control selectric">
                                            <option selected disabled>Pilih Tingkat Kelas</option>
                                            <option>X</option>
                                            <option>XI</option>
                                            <option>XII</option>
                                        </select>
                                        @error('tingkat_kelas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Jurusan --}}
                                <div class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jurusan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="jurusan" id="jurusan" class="form-control selectric">
                                            <option selected disabled>Pilih Jurusan</option>
                                            <option>IPA</option>
                                            <option>IPS</option>
                                            <option>AGAMA</option>
                                        </select>
                                        @error('jurusan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Nama --}}
                                <div id="nama" class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="nama" class="form-control @error('nama') is-invalid @enderror"
                                            type="text" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Tahun Masuk --}}
                                <div id="tahun_masuk" class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun Masuk</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="tahun_masuk"
                                            class="form-control @error('tahun_masuk') is-invalid @enderror"
                                            value="{{ old('tahun_masuk') }} " id="tahun_masuk_input" type="number"
                                            min="2020" max="2099" value="{{ old('tahun_masuk') }}"
                                            oninput="updateTahunKeluar()">
                                        @error('tahun_masuk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Tahun Keluar --}}
                                <div id="tahun_keluar" class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun Keluar</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="tahun_keluar"
                                            class="form-control @error('tahun_keluar') is-invalid @enderror"
                                            value="{{ old('tahun_keluar') }}" id="tahun_keluar_input" type="number"
                                            min="2020" max="2099" readonly>
                                        @error('tahun_keluar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Daftar --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Buat Kelas</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function updateTahunKeluar() {
            var tahunMasukInput = document.getElementById('tahun_masuk_input');
            var tahunMasuk = parseInt(tahunMasukInput.value);

            if (!isNaN(tahunMasuk)) {
                var tahunKeluar = tahunMasuk + 1;
                document.getElementById('tahun_keluar_input').value = tahunKeluar;
            } else {
                document.getElementById('tahun_keluar_input').value = "";
            }
        }
    </script>
@endsection
