@extends('layouts.admin.app', ['title' => 'Edit User'])

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('user.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></div>
                <div class="breadcrumb-item">Edit User</div>
            </div>
        </div>

        <div class="section-body">
            <form method="post" action="/admin/user/{{ $user->id }}">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit User</h4>
                            </div>
                            <div class="card-body">
                                {{-- Username --}}
                                <div id="username" class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="usernameInput" name="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror""
                                            value="{{ $user->username }}" required autofocus>
                                    </div>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Guru ID --}}
                                <div id="guruId" class="form-group row mb-4" style="display:none;">
                                    <label for="guruIdInput"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Guru ID</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="guruIdInput" name="guru_id" type="text"
                                            class="form-control @error('guru_id') is-invalid @enderror"
                                            value="{{ $user->guru_id }}">
                                    </div>
                                    @error('guru_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Siswa ID --}}
                                <div id="siswaId" class="form-group row mb-4" style="display:none;">
                                    <label for="siswaIdInput"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Siswa ID</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="siswaIdInput" name="siswa_id" type="text"
                                            class="form-control @error('siswa_id') is-invalid @enderror"
                                            value="{{ $user->siswa_id }}">
                                    </div>
                                    @error('siswa_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Role --}}
                                <div class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="role" id="role" class="form-control selectric">
                                            <option>{{ $user->role }}</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- Password --}}
                                <div class="form-group row mb-4">
                                    <label for="password"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="password" type="password" name="password" class="form-control inputtags"
                                            required>
                                    </div>
                                </div>
                                {{-- Konfirm --}}
                                <div class="form-group row mb-4">
                                    <label for="password_confirmation"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi
                                        Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                            class="form-control inputtags" required>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Daftar --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Update User</button>
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
    <script></script>
@endsection
