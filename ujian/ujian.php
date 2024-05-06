<?php
session_start();
if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Ujian - SDN 3 KUJANGSARI";
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
if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> Data Siswa berhasil diupdate.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>
<script>
    // Fungsi untuk menampilkan popup
    function showPopup(message) {
        alert(message);
    }

    // Ambil nilai msg dari URL jika ada
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');

    // Tampilkan popup jika ada pesan
    if (msg) {
        showPopup(msg);
    }
</script>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">DATA UJIAN</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Data Ujian</li>
                <?php
                if ($msg !== '') {
                    echo $alert;
                }
                ?>
            </ol>
            <div class="card">
                <div class="card-header" style="background-color: #568CDD; color: #fff; padding: 10px; border-bottom: 2px solid #568CDD;">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> DATA UJIAN</span>
                    <div class="dropdown float-end">
                        <a href="nilai-ujian.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> TAMBAH DATA UJIAN</a>
                        <button class="btn btn-sm btn-primary dropdown-toggle me-1" type="button" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-print"></i> CETAK
                        </button>
                        <ul style="text-align: center;" class="dropdown-menu">
                            <li><button type="button" onclick="printDoc()" class="dropdown-item"><i class="fas fa-file-alt"></i> HASIL UJIAN</button></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-center" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>NO UJIAN</center>
                                </th>
                                <th scope="col">
                                    <center>NIS</center>
                                </th>
                                <th scope="col">
                                    <center>KELAS</center>
                                </th>
                                <th scope="col">
                                    <center>NILAI TERENDAH</center>
                                </th>
                                <th scope="col">
                                    <center>NILAI TERTINGGI</center>
                                </th>
                                <th scope="col">
                                    <center>NILAI RATA RATA</center>
                                </th>
                                <th scope="col">
                                    <center>HASIL UJIAN</center>
                                </th>
                                <th scope="col">
                                    <center>Aksi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryUjian = mysqli_query($koneksi, "SELECT * FROM tbl_ujian");
                            while ($data = mysqli_fetch_array($queryUjian)) {
                            ?>
                                <tr>
                                    <td><?= $data['no_ujian'] ?></td>
                                    <td><?= $data['nis'] ?></td>
                                    <td><?= $data['kelas'] ?></td>
                                    <td align="center"><?= $data['nilai_terendah'] ?></td>
                                    <td align="center"><?= $data['nilai_tertinggi'] ?></td>
                                    <td align="center"><?= $data['nilai_rata2'] ?></td>
                                    <td>
                                        <?php if ($data['hasil_ujian'] == 'LULUS') { ?>
                                            <button type="button" class="btn btn-success btn-sm rounded-0 col-10 fw-bold text-uppercase"><?= $data['hasil_ujian'] ?></button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-danger btn-sm rounded-0 col-10 fw-bold text-uppercase"><?= $data['hasil_ujian'] ?></button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <form action="proses-hapus-ujian.php" method="POST">
                                            <input type="hidden" name="no_ujian" value="<?= $data['no_ujian'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm rounded-0" onclick="return confirm('Anda yakin ingin menghapus data ujian ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        function printDoc() {
            const myWindow = window.open("../report/r-ujian.php", "", "width=900, height=600, left=100");
        }
    </script>


    <?php require_once "../template/footer.php"; ?>
</div>