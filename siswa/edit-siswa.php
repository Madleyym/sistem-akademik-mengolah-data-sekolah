<?php

// siswa\siswa.php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Update Siswa - SDN 3 KUJANGSARI";

require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";



$nis = $_GET['nis'];
$siswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE nis = '$nis'");
$data = mysqli_fetch_array($siswa);


// Periksa apakah ada pesan notifikasi yang diterima
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = "";
}
$alert = '';

// Tambahkan notifikasi sesuai dengan pesan yang diterima
if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> Data Siswa berhasil diupdate.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'cancel') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-xmark"></i> Gagal mengupdate data Siswa, NIS sudah ada.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">UPDATE SISWA</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item "><a href="siswa.php">Siswa</a></li>
                <li class="breadcrumb-item active">Update Siswa</li>
            </ol>
            <!-- Menampilkan notifikasi di sini -->
            <?php if ($alert !== '') {
                echo $alert;
            } ?>
            <!-- <form action="proses-siswa.php" method="$_POST" enctype="multipart/form-data"> -->
            <form action="proses-siswa.php" method="POST" enctype="multipart/form-data">

                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-pen-to-square"></i> Update Siswa</span>
                        <button type="submit" name="update" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> UPDATE </class=></button>
                        <!-- <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i class="fa-solid fa-floppy-disk"></i> RESET</class=></button> -->
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                                    <label for="nis" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nis" readonly class="form-control-plaintext border-bottom ps-2" id="nis" value="<?= $nis ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
                                    <label for="nis" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama" required class="form-control border-0 border-bottom ps-2" id="nama" value="<?= $data['nama'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="kelas" class="col-sm-2 col-form-label">KELAS</label>
                                    <label for="kelas" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <select name="kelas" id="kelas" class="form-select border-0 border-bottom ps-2" required>
                                            <?php
                                            $kelas = ["1", "2", "3", "4", "5", "6"];
                                            foreach ($kelas as $kls) {
                                                if ($data['kelas'] == $kls) { ?>
                                                    <option value="<?= $kls; ?>" selected><?= $kls; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $kls; ?>"><?= $kls; ?></option>

                                            <?php
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
                                    <label for="nis" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3" placeholder="alamat siswa" class="form-control" required><?= $data['alamat'] ?></textarea>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center px-5">
                                <input type="hidden" name="fotoLama" value="<?= $data['foto'] ?>">
                                <img src="../assets/img/<?= $data['foto'] ?>" alt="Foto siswa" class="mb-3 rounded-circle" width="40%">
                                <input type="file" name="image" class="form-control form-control-sm">
                                <small class="text-secondary">Pilih> Foto, PNG, JEPG, JPG. Maximal 2MB</small>
                                <div><small class="text-secondary"> width = height</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php
    require_once "../template/footer.php"

    ?>