@extends('layouts.admin.app', ['title' => 'Dashboard'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        {{-- Total Akun --}}
        <div class="row">
            {{-- Siswa --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Siswa</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalSiswa }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Guru --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Guru</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalGuru }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Kelas --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kelas</h4>
                        </div>
                        <div class="card-body">
                            42
                        </div>
                    </div>
                </div>
            </div>
            {{-- User --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-dark">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>User</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalUsers }}
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Referral URL</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">2,100</div>
                            <div class="font-weight-bold mb-1">Google</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="80%" aria-valuenow="80"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">1,880</div>
                            <div class="font-weight-bold mb-1">Facebook</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="67%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">1,521</div>
                            <div class="font-weight-bold mb-1">Bing</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="58%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">884</div>
                            <div class="font-weight-bold mb-1">Yahoo</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="36%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">473</div>
                            <div class="font-weight-bold mb-1">Kodinger</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="28%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">418</div>
                            <div class="font-weight-bold mb-1">Multinity</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="20%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>This Week Stats</h4>
                        <div class="card-header-action">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-primary"
                                    data-toggle="dropdown">Filter</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i>
                                        Electronic</a>
                                    <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i>
                                        T-shirt</a>
                                    <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i>
                                        Hat</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="summary">
                            <div class="summary-info">
                                <h4>$1,053</h4>
                                <div class="text-muted">Sold 3 items on 2 customers</div>
                                <div class="d-block mt-2">
                                    <a href="#">View All</a>
                                </div>
                            </div>
                            <div class="summary-item">
                                <h6>Item List <span class="text-muted">(3 Items)</span></h6>
                                <ul class="list-unstyled list-unstyled-border">
                                    <li class="media">
                                        <a href="#">
                                            <img class="mr-3 rounded" width="50"
                                                src="../assets/img/products/product-1-50.png" alt="product">
                                        </a>
                                        <div class="media-body">
                                            <div class="media-right">$405</div>
                                            <div class="media-title"><a href="#">PlayStation 9</a></div>
                                            <div class="text-muted text-small">by <a href="#">Hasan Basri</a>
                                                <div class="bullet"></div> Sunday
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a href="#">
                                            <img class="mr-3 rounded" width="50"
                                                src="../assets/img/products/product-2-50.png" alt="product">
                                        </a>
                                        <div class="media-body">
                                            <div class="media-right">$499</div>
                                            <div class="media-title"><a href="#">RocketZ</a></div>
                                            <div class="text-muted text-small">by <a href="#">Hasan Basri</a>
                                                <div class="bullet"></div> Sunday
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a href="#">
                                            <img class="mr-3 rounded" width="50"
                                                src="../assets/img/products/product-3-50.png" alt="product">
                                        </a>
                                        <div class="media-body">
                                            <div class="media-right">$149</div>
                                            <div class="media-title"><a href="#">Xiaomay Readme 4.0</a></div>
                                            <div class="text-muted text-small">by <a href="#">Kusnaedi</a>
                                                <div class="bullet"></div> Tuesday
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Latest Posts</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Introduction Laravel 5
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
                                    </tr>
                                    <tr>
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
                                    </tr>
                                    <tr>
                                        <td>
                                            Laravel 5 Tutorial - MVC
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
                                    </tr>
                                    <tr>
                                        <td>
                                            Laravel 5 Tutorial - Migration
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
                                    </tr>
                                    <tr>
                                        <td>
                                            Laravel 5 Tutorial - Deploy
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
                                    </tr>
                                    <tr>
                                        <td>
                                            Laravel 5 Tutorial - Closing
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
