@extends('layouts.admin.app', ['title' => 'Dashboard'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
        </div>

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
                                    @foreach ($users as $no => $user)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>

                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>

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
{{-- <tr>
                                            <td>2</td>
                                            <td>
                                                Laravel 5 Tutorial - Installation
                                                <div class="table-links">
                                                    in <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="font-weight-600"><img
                                                    src="../assets/img/avatar/avatar-1.png" alt="avatar" width="30"
                                                    class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr> --}}
