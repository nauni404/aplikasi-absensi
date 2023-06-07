@extends('layouts.admin.app', ['title' => 'Tambah Guru'])

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('guru.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Guru</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('guru.index') }}">Guru</a></div>
                <div class="breadcrumb-item">Tambah Guru</div>
            </div>
        </div>
        <div class="section-body">
            <form method="post" action="/admin/guru">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Guru</h4>
                            </div>
                            <div class="card-body">
                                {{-- NIP --}}
                                <div id="nip" class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="nip" type="text"
                                            class="form-control @error('nip') is-invalid @enderror"
                                            value="{{ old('nip') }}" autofocus>
                                        @error('nip')
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
                                {{-- Jenis Kelamin --}}
                                <div class="form-group row mb-4">
                                    <label for="jk"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="jk" id="jk"
                                            class="form-control selectric @error('jk') is-invalid @enderror">
                                            <option selected disabled>Pilih Jenis</option>
                                            <option value="L" @if (old('jk') == 'L') selected @endif>L
                                            </option>
                                            <option value="P" @if (old('jk') == 'P') selected @endif>P
                                            </option>
                                        </select>
                                        @error('jk')
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
                                        <button type="submit" class="btn btn-primary">Buat Guru</button>
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
@endsection
