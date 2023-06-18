@extends('layouts.admin.app', ['title' => 'Data Kelas'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Rekap Absensi Siswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item">Rekap</div>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible show fade col-lg-12 col-md-12 col-12">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible show fade col-lg-12 col-md-12 col-12">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pilih Rekap</h4>
                    </div>
                    @if (count($kelas) > 0)
                        <form action="rekap/view" method="GET" onsubmit="return validateForm()">
                            <div class="card-body">
                                {{-- Kelas --}}
                                <div class="form-group row mb-4">
                                    <label for="kelas_id"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilih Kelas:</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="kelas_id" id="kelas_id" class="form-control required"
                                            onChange="resetJadwalOptions()">
                                            <option selected disabled>-- Pilih Kelas --</option>
                                            @foreach ($kelas as $kelasItem)
                                                <option value="{{ $kelasItem->id }}">
                                                    {{ $kelasItem->tingkat_kelas . ' ' . $kelasItem->jurusan . ' ' . $kelasItem->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- Jadwal --}}
                                <div class="form-group row mb-4">
                                    <label for="jadwal_id"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilih Jadwal:</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="jadwal_id" id="jadwal_id" class="form-control" required>
                                            <option selected disabled>-- Pilih Jadwal --</option>
                                            @foreach ($jadwal as $jadwalItem)
                                                <option value="{{ $jadwalItem->id }}"
                                                    data-kelas="{{ $jadwalItem->kelas_id }}" style="display: none;">
                                                    {{ $jadwalItem->guru->nama . ' - ' . $jadwalItem->mapel->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- Rekap --}}
                                <div class="form-group row mb-4">
                                    <label for="rekap"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilih
                                        Rekapitulasi:</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="rekap" id="rekap" class="form-control" required>
                                            <option selected disabled>-- Pilih Waktu Rekap --</option>
                                            <option value="hari">Hari ini</option>
                                            <option value="minggu">Minggu ini</option>
                                            <option value="bulan">Bulan ini</option>
                                            <option value="custom">Custom Tanggal</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="custom-date">
                                    <div class="form-group row mb-4">
                                        <label for="start_date"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal
                                            Awal:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="date" name="start_date" id="start_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="end_date"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal
                                            Akhir:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="date" name="end_date" id="end_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">
                                            Tampilkan Rekapitulasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>Tidak ada kelas yang terdaftar</h2>
                                <p class="lead">
                                    Untuk menghilangkan pesan ini, buat setidaknya 1 kelas.
                                </p>
                                <a href="/admin/kelas/create" class="btn btn-primary mt-4">Tambah Kelas
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js')
    <script>
        function validateForm() {
            var kelasId = document.getElementById("kelas_id").value;
            var jadwalId = document.getElementById("jadwal_id").value;
            var rekap = document.getElementById("rekap").value;

            if (kelasId == "-- Pilih Kelas --" || jadwalId == "-- Pilih Jadwal --" || rekap == "-- Pilih Waktu Rekap --") {
                alert("Mohon lengkapi semua opsi yang tersedia.");
                return false;
            }

            if (rekap == "custom") {
                var startDate = document.getElementById("start_date").value;
                var endDate = document.getElementById("end_date").value;

                if (startDate == "" || endDate == "") {
                    alert("Mohon pilih tanggal awal dan tanggal akhir.");
                    return false;
                }

                // Validasi apakah tanggal awal lebih kecil atau sama dengan tanggal akhir
                if (startDate > endDate) {
                    alert("Tanggal awal harus sebelum tanggal akhir.");
                    return false;
                }
            }
        }

        function resetJadwalOptions() {
            var kelasId = document.getElementById("kelas_id").value; // Mendapatkan nilai kelas_id yang dipilih
            var jadwalSelect = document.getElementById("jadwal_id"); // Mendapatkan elemen select "jadwal"

            // Menghapus semua opsi dalam elemen select "jadwal"
            jadwalSelect.innerHTML = '<option selected disabled>-- Pilih Jadwal --</option>';

            // Menambahkan opsi baru berdasarkan kelas_id yang dipilih
            var jadwalOptions = <?php echo json_encode($jadwal); ?>; // Mendapatkan daftar jadwal dari PHP

            for (var i = 0; i < jadwalOptions.length; i++) {
                if (jadwalOptions[i].kelas_id == kelasId) {
                    var option = document.createElement("option");
                    option.value = jadwalOptions[i].id;
                    option.text = jadwalOptions[i].guru.nama + ' - ' + jadwalOptions[i].mapel.nama;
                    jadwalSelect.appendChild(option);
                }
            }
        }

        // Pada awalnya sembunyikan div custom-date
        document.getElementById("custom-date").style.display = "none";

        // Tambahkan event listener untuk menampilkan/menyembunyikan div custom-date
        document.getElementById("rekap").addEventListener("change", function() {
            var rekapValue = this.value;
            if (rekapValue === "custom" || rekapValue === "-- Pilih Waktu Rekap --") {
                document.getElementById("custom-date").style.display = "block";
            } else {
                document.getElementById("custom-date").style.display = "none";
            }
        });
    </script>
@endsection
