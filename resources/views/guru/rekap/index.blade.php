@extends('layouts.guru.app', ['title' => 'Data Kelas'])

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
            <div class="alert alert-success alert-dismissible show fade col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible show fade col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pilih Rekap</h4>
                    </div>
                    @if (count($kelas) > 0)
                        <form action="rekap/view" method="GET" onsubmit="return validateForm()">
                            <div class="card-body">
                                {{-- Kelas --}}
                                <div class="form-group">
                                    <label for="kelas_id">Pilih Kelas:</label>
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
                                {{-- Jadwal --}}
                                <div class="form-group">
                                    <input type="hidden" name="jadwal_id" id="jadwal_id_hidden" value="" required>
                                </div>
                                {{-- Rekap --}}
                                <div class="form-group">
                                    <label for="rekap">Pilih Rekapitulasi:</label>
                                    <select name="rekap" id="rekap" class="form-control" required>
                                        <option selected disabled>-- Pilih Waktu Rekap --</option>
                                        <option value="hari">Per Hari</option>
                                        <option value="minggu">Per Minggu</option>
                                        <option value="bulan">Per Bulan</option>
                                        <option value="custom">Custom Tanggal</option>
                                    </select>
                                </div>
                                <div class="form-group" id="custom-date">
                                    <label for="start_date">Tanggal Awal:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                    <label for="end_date">Tanggal Akhir:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Tampilkan Rekapitulasi</button>
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
                                    Untuk menghilangkan pesan ini, beritahu admin untuk buat setidaknya 1 kelas.
                                </p>
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
            var jadwalSelect = document.getElementById(
                "jadwal_id_hidden"); // Mengambil elemen input hidden "jadwal_id_hidden"

            // Menghapus nilai jadwal_id_hidden yang ada
            jadwalSelect.value = '';

            // Mendapatkan daftar jadwal yang berhubungan dengan kelas_id yang dipilih
            var jadwalOptions = <?php echo json_encode($jadwal); ?>;

            // Mencari jadwal yang sesuai dengan kelas_id yang dipilih
            for (var i = 0; i < jadwalOptions.length; i++) {
                if (jadwalOptions[i].kelas_id == kelasId) {
                    jadwalSelect.value = jadwalOptions[i]
                        .id; // Mengupdate nilai jadwal_id_hidden dengan id jadwal yang berhubungan
                    break;
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
