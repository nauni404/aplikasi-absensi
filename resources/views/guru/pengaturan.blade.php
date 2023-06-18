@extends('layouts.guru.app', ['title' => 'Dashboard'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item">Pengaturan</div>
            </div>
        </div>
        {{-- Ubah Username --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">{{ __('Change Username') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('change-username-guru') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="current_username"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Current Username') }}</label>
                                    <div class="col-md-6">
                                        <input id="current_username" type="text" class="form-control"
                                            value="{{ $user->username }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_username"
                                        class="col-md-4 col-form-label text-md-right">{{ __('New Username') }}</label>

                                    <div class="col-md-6">
                                        <input id="new_username" type="text"
                                            class="form-control @error('new_username') is-invalid @enderror"
                                            name="new_username" required autocomplete="new-username">

                                        @error('new_username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Change Username') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Ubah Password --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Change Password') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('change-password-guru') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="current_password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="current_password" type="password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            name="current_password" required autocomplete="current-password">

                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="new_password" type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            name="new_password" required autocomplete="new-password">

                                        @error('new_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_password_confirmation"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="new_password_confirmation" type="password" class="form-control"
                                            name="new_password_confirmation" required autocomplete="new-password">
                                        @error('new_password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Change Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
