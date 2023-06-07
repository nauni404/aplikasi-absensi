@extends('layouts.admin.app', ['title' => 'Edit Jadwal'])

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('jadwal.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Jadwal</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('jadwal.index') }}">Jadwal</a></div>
                <div class="breadcrumb-item">Edit Jadwal</div>
            </div>
        </div>
        <div class="section-body">
            <form method="post" action="/admin/jadwal/{{ $jadwal->id }}">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Jadwal</h4>
                            </div>
                            <div class="card-body">
                                {{-- Guru --}}
                                <div class="form-group row mb-4">
                                    <label for="guru_id"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Guru</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="guru_id" id="guru_id"
                                            class="form-control selectric @error('guru_id') is-invalid @enderror">
                                            @foreach ($gurus as $guru)
                                                <option value="{{ $guru->id }}"
                                                    {{ $jadwal->guru_id == $guru->id ? 'selected' : '' }}>
                                                    {{ $guru->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('guru_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Mapel --}}
                                <div class="form-group row mb-4">
                                    <label for="mapel_id"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Mapel</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="mapel_id" id="mapel_id"
                                            class="form-control selectric @error('mapel_id') is-invalid @enderror">
                                            @foreach ($mapels as $mapel)
                                                <option value="{{ $mapel->id }}"
                                                    {{ $jadwal->mapel_id == $mapel->id ? 'selected' : '' }}>
                                                    {{ $mapel->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mapel_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Kelas --}}
                                <div class="form-group row mb-4">
                                    <label for="kelas_id"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelas</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="kelas_id" id="kelas_id"
                                            class="form-control selectric @error('kelas_id') is-invalid @enderror">
                                            @foreach ($kelas as $kelas)
                                                <option value="{{ $kelas->id }}"
                                                    {{ $jadwal->kelas_id == $kelas->id ? 'selected' : '' }}>
                                                    {{ $kelas->tingkat_kelas . ' ' . $kelas->jurusan . ' ' . $kelas->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Hari --}}
                                <div id="hari" class="form-group row mb-4">
                                    <label for="hari"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hari</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="hari" class="form-control @error('hari') is-invalid @enderror"
                                            type="text" value="{{ $jadwal->hari }}">
                                        @error('hari')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Jam Mulai --}}
                                <div id="jam_mulai" class="form-group row mb-4">
                                    <label for="jam_mulai" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jam
                                        Mulai</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="jam_mulai"
                                            class="form-control @error('jam_mulai') is-invalid @enderror" type="time"
                                            value="{{ $jadwal->jam_mulai }}">
                                        @error('jam_mulai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Jam Selesai --}}
                                <div id="jam_selesai" class="form-group row mb-4">
                                    <label for="jam_selesai"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jam Selesai</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="jam_selesai"
                                            class="form-control @error('jam_selesai') is-invalid @enderror" type="time"
                                            value="{{ $jadwal->jam_selesai }}">
                                        @error('jam_selesai')
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
                                        <button type="submit" class="btn btn-primary">Update Jadwal</button>
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
