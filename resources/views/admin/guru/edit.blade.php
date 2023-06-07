@extends('layouts.admin.app', ['title' => 'Edit Guru'])

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('guru.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Guru</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('guru.index') }}">Guru</a></div>
                <div class="breadcrumb-item">Edit Guru</div>
            </div>
        </div>
        <div class="section-body">
            <form method="post" action="/admin/guru/{{ $guru->id }}">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Guru</h4>
                            </div>
                            <div class="card-body">
                                {{-- NIP --}}
                                <div id="nip" class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIS</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="nip" type="text"
                                            class="form-control @error('nip') is-invalid @enderror""
                                            value="{{ $guru->nip }}" autofocus>
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
                                        <input name="nama" type="text"
                                            class="form-control @error('nama') is-invalid @enderror""
                                            value="{{ $guru->nama }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Jenis Kelamin --}}
                                <div class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="jk" id="jk" class="form-control selectric">
                                            <option>{{ $guru->jk }}</option>
                                            @if ($guru->jk == 'L')
                                                <option>P</option>
                                            @elseif ($guru->jk == 'P')
                                                <option>L</option>
                                            @endif
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
                                        <button type="submit" class="btn btn-primary">Update Guru</button>
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
