@extends('layouts.admin.app', ['title' => 'Dashboard'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
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
                        <h4>Daftar User</h4>
                        <div class="card-header-action">
                            <a href="/admin/user/create" class="btn btn-primary">Tambah User</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>

                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                    title="Edit" href="/admin/user/{{ $user->id }}/edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="deleteUser({{ $user->id }})"><i
                                                        class="fas fa-trash"></i> </a>
                                                <form id="deleteForm-{{ $user->id }}" method="POST">
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
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function deleteUser(userId) {
            // Mengambil referensi formulir dengan menggunakan ID yang unik
            var form = document.getElementById('deleteForm-' + userId);

            // Mengatur atribut action pada formulir
            form.action = "user/" + userId; // Misalkan URL delete berisi parameter user ID

            // Melakukan submit formulir
            form.submit();
        }
    </script>
@endsection
