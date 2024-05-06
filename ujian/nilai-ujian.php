<?php
session_start();
if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Nilai Ujian - SDN 3 KUJANGSARI";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if (isset($_GET['msg']) && isset($_GET['nis'])) {
    $msg = $_GET['msg'];
    $nis = $_GET['nis'];
} else {
    $msg = "";
    $nis = "";
}
$alert = '';

// Tambahkan notifikasi sesuai dengan pesan yang diterima
if ($msg == 'LULUS') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> Selamat.. Siswa dengan NIS : ' . $nis . 'berhasil LULUS UJIAN
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}


// Tambahkan notifikasi sesuai dengan pesan yang diterima
if ($msg == 'GAGAL') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-xmark"></i> Siswa dengan NIS : ' . $nis . 'GAGAL LULUS UJIAN
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}


$queryNoUjian = mysqli_query($koneksi, "SELECT max(no_ujian) as maxno FROM tbl_ujian");
$data = mysqli_fetch_array($queryNoUjian);
$maxno = $data['maxno'];

$noUrut = (int) substr($maxno, 4, 3);
$noUrut++;
$maxno = "UTS-" . sprintf("%03s", $noUrut);
?>
<script>
    // JavaScript untuk menampilkan pesan alert jika NIS sudah digunakan
    var msg = "<?php echo $msg; ?>";
    if (msg !== "") {
        showAlert(msg); // Panggil fungsi showAlert dengan pesan yang diterima
    }

    // Fungsi untuk menampilkan pesan alert
    function showAlert(message) {
        alert(message);
    }
</script>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-4">
                    <h1 class="mt-4">NILAI UTS UAS</h1>
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="ujian.php">Ujian</a></li>
                        <li class="breadcrumb-item active">Nilai Ujian</li>
                    </ol>
                </div>
                <?php
                if ($msg !== '') {
                    echo $alert;
                }
                ?>
                <!-- <div class="card-col-4">
                    <div class="card mt-1 border-0">
                        <h5>SYARAT KELULUSAN</h5>
                        <ul class="ps-3">
                            <li><small>Nilai minimal setiap Mata Pelajaran tidak boleh di bawah 50</small></li>
                            <li><small>Nilai rata-rata setiap Mata Pelajaran tidak boleh di bawah 60</small></li>
                        </ul>
                    </div>
                </div> -->
            </div>

            <div class="card">
                <div class="card-header">
                    <style>
                        .card-header {
                            background-color: #568CDD;
                            color: #fff;
                            padding: 10px;
                            border-bottom: 2px solid #568CDD;
                        }
                    </style>
                    <i class="fa-solid fa-users"></i> DATA PESERTA UJIAN
                </div>
                <script>
                    function showAlert(message) {
                        alert(message);
                    }
                </script>
                <div class="card-body">
                    <form action="proses-nilai-ujian.php" method="POST">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header"> <i class="fa-solid fa-list"></i> DATA NILAI</div>
                                    <div class="card-body">
                                        <div class="input-group mb-2">
                                            <label for="noUjian" class="form-label small mb-1">NOMOR UJIAN</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-rotate"></i></span>
                                                <input type="text" name="noUjian" value="<?= $maxno ?>" class="form-control bg-transparent" readonly>
                                            </div>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="noUjian" class="form-label small mb-1">KALENDER</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calendar-days"></i></i></span>
                                                <input type="date" name="tgl" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="nis" class="form-label small mb-1">NIS</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                <select name="nis" id="nis" class="form-select" required>
                                                    <option value="">-- Pilih Siswa --</option>
                                                    <?php
                                                    $querySiswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa");
                                                    while ($data = mysqli_fetch_array($querySiswa)) { ?>
                                                        <option value="<?= $data['nis'] ?>"><?= $data['nis'] . ' - ' . $data['nama'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- di peruntukan KELAS -->
                                        <div class="input-group mb-2">
                                            <label for="kelas" class="form-label small mb-1">KELAS</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-location-arrow"></i></span>
                                                <select name="kelas" id="kelas" class="form-select" required>
                                                    <option value="">-- KELAS 6 -- </option>
                                                    <option value="A">kelas A</option>
                                                    <option value="B">kelas B</option>
                                                    <option value="C">kelas C</option>
                                                    <!-- <option value="D">kelas D</option>
                                                    <option value="E">kelas E</option>
                                                    <option value="F">kelas F</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="sum" class="form-label small mb-1">SUM</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                                                <input type="text" name="sum" class="form-control" placeholder="Total Nilai" id="total_nilai" required readonly>
                                            </div>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="sum" class="form-label small mb-1">MIN</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                                                <input type="text" name="min" class="form-control" placeholder="Nilai Terendah" id="nilai_terendah" required readonly>
                                            </div>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="sum" class="form-label small mb-1">MAX</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                                                <input type="text" name="max" class="form-control" placeholder="Nilai Tertinggi" id="nilai_tertinggi" required readonly>
                                            </div>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="sum" class="form-label small mb-1">AVG</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                                                <input type="text" name="avg" class="form-control" placeholder="Nilai Rata-rata" id="nilai_rata2" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fa-solid fa-list"></i> INPUT NILAI UJIAN
                                    </div>
                                    <div class="card-footer border-0">
                                        <button type="submit" name="simpan" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-save"></i> SIMPAN</button>
                                        <button type="reset" name="reset" class="btn btn-sm btn-danger me-1 float-end"><i class="fa-solid fa-times"></i> RESET</button>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover text-center table-bordered" id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        <center>No</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>Kelas</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>Mata Pelajaran</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>Nilai Ujian</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <!-- ini nanti ganti kelas -->
                                            <tbody id="kejuran">

                                            </tbody>
                                        </table>
                                        <!-- Input Nilai Ujian -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        const kelas = document.getElementById('kelas');
        const mapelKejuran = document.getElementById('kejuran');

        kelas.addEventListener('change', function() {
            let ajax = new XMLHttpRequest();

            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4 && this.status == 200) {
                    mapelKejuran.innerHTML = ajax.responseText;
                    // document.querySelector('#datatablesSimple tbody').innerHTML = ajax.responseText;
                }
            }

            ajax.open('GET', 'ajax-mapel.php?kelas=' + kelas.value, true);
            ajax.send();

        })

        const total = document.getElementById('total_nilai');
        const minValue = document.getElementById('nilai_terendah');
        const maxValue = document.getElementById('nilai_tertinggi');
        const average = document.getElementById('nilai_rata2');

        function fnhitung() {
            let nilaiUjian = document.getElementsByClassName('nilai');

            let totalNilai = 0;
            let listNilai = [];
            for (let i = 0; i < nilaiUjian.length; i++) {
                totalNilai = parseInt(totalNilai) + parseInt(nilaiUjian[i].value);
                total.value = totalNilai;

                listNilai.push(nilaiUjian[i].value)

                listNilai.sort(function(a, b) {
                    return a - b
                });

                minValue.value = listNilai[0];
                maxValue.value = listNilai[listNilai.length - 1];
                average.value = Math.round(totalNilai / listNilai.length);


            }
        }
    </script>

    <?php require_once "../template/footer.php"; ?>
</div>