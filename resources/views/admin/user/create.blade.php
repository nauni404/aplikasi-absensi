@extends('layouts.admin.app', ['title' => 'Tambah User'])

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('user.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></div>
                <div class="breadcrumb-item">Tambah User</div>
            </div>
        </div>
        <div class="section-body">
            <form method="post" action="/admin/user">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah User</h4>
                            </div>
                            <div class="card-body">
                                {{-- Role --}}
                                <div class="form-group row mb-4">
                                    <label for="role"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="role" id="role"
                                            class="form-control selectric @error('role') is-invalid @enderror">
                                            <option selected disabled>Pilih Role</option>
                                            <option value="Admin" @if (old('role') == 'Admin') selected @endif>Admin
                                            </option>
                                            <option value="Guru" @if (old('role') == 'Guru') selected @endif>Guru
                                            </option>
                                            <option value="Siswa" @if (old('role') == 'Siswa') selected @endif>Siswa
                                            </option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Username --}}
                                <div id="username" class="form-group row mb-4">
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="usernameInput" name="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror""
                                            value="{{ old('username') }}" autofocus>
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Guru --}}
                                <div id="guru_id" class="form-group row mb-4" hidden>
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username (NIP)</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="guru_id" id="guru_id_select" class="form-control selectric">
                                            <option selected disabled>Pilih Guru</option>
                                            @foreach ($guru as $gur)
                                                @if (!$gur->hasAccount())
                                                    <option value="{{ $gur->id }}" data-nip="{{ $gur->nip }}">
                                                        {{ $gur->nip . ' - ' . $gur->nama }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- Siswa --}}
                                <div id="siswa_id" class="form-group row mb-4" hidden>
                                    <label for="name"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username
                                        (NIS)</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="siswa_id" id="siswa_id_select" class="form-control selectric">
                                            <option selected disabled>Pilih Siswa</option>
                                            @foreach ($siswa as $sis)
                                                @if (!$sis->hasAccount())
                                                    <option value="{{ $sis->id }}" data-nis="{{ $sis->nis }}">
                                                        {{ $sis->nis . ' - ' . $sis->nama }}
                                                    </option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                {{-- Password --}}
                                <div class="form-group row mb-4">
                                    <label for="password"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="password" type="password" name="password"
                                            class="form-control inputtags @error('password') is-invalid @enderror"">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Konfirmasi Password --}}
                                <div class="form-group row mb-4">
                                    <label for="password_confirmation"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi
                                        Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                            class="form-control inputtags @error('password_confirmation') is-invalid @enderror"">
                                        @error('password_confirmation')
                                            <div class="feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Daftar --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Buat User</button>
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
        $(document).ready(function() {
            $('#role').change(function() {
                var selectedRole = $(this).val();
                if (selectedRole === "Siswa") {
                    $('#guru_id').attr('hidden', true);
                    $('#siswa_id').removeAttr('hidden');
                    $('#guru_id select').val('');
                    $('#username').hide();
                    var selectedOption = $('#siswa_id_select option:selected');
                    var selectedNIS = selectedOption.data('nis');
                    $('#usernameInput').val(selectedNIS);
                } else if (selectedRole === "Guru") {
                    $('#guru_id').removeAttr('hidden');
                    $('#siswa_id').attr('hidden', true);
                    $('#siswa_id select').val('');
                    $('#username').hide();
                    var selectedOption = $('#guru_id_select option:selected');
                    var selectedNIP = selectedOption.data('nip');
                    $('#usernameInput').val(selectedNIP);
                } else {
                    $('#guru_id').attr('hidden', true);
                    $('#siswa_id').attr('hidden', true);
                    $('#siswa_id select').val('');
                    $('#guru_id select').val('');
                    $('#username').show();
                    $('#usernameInput').val('');
                }
            });
            $('#siswa_id_select').change(function() {
                var selectedOption = $(this).find('option:selected');
                var selectedNIS = selectedOption.data('nis');
                $('#usernameInput').val(selectedNIS);
            });
            $('#guru_id_select').change(function() {
                var selectedOption = $(this).find('option:selected');
                var selectedNIP = selectedOption.data('nip');
                $('#usernameInput').val(selectedNIP);
            });
        });
    </script>
@endsection
