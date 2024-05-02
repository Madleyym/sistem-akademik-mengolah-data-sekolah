<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}
require_once "../config.php";

$title = "Guru - SDN 3 KUJANGSARI";

require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = "";
}
$alert = '';
if ($msg == 'cancel') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-exclamation"></i> Galat! Tambah Guru Gagal, NIP sudah ada.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if ($msg == 'notimage') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-exclamation"></i> Galat! yang anda masukan bukan jpg .jpeg .png
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if ($msg == 'oversize') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-exclamation"></i> Galat! ukuran file terlalu besar.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> Tambah Guru berhasil. Silahkan Ganti Password, Password Default 1234.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Guru</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item "><a href="guru.php">Guru</a></li>
                <li class="breadcrumb-item active">Tambah Guru</li>
            </ol>
            <form method="post" action="proses-guru.php" enctype="multipart/form-data">
                <?php if ($msg !== '') {
                    echo $alert;
                } ?>
                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i> Tambah Guru</span>
                        <button type="submit" name="simpan" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> SIMPAN</button>
                        <button type="reset" name="reset" class="btn btn-sm btn-danger float-end me-1"><i class="fa-solid fa-xmark"></i> RESET</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="row mb-3">
                                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                                    <label for="nip" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nip" pattern="[0-9]{18}" title="NIP harus 18 angka" class="form-control ps-2 border-0 border-bottom" required>
                                        <?php
                                        // Check if NIP already exists
                                        if ($msg == 'cancel') {
                                            echo '<div class="invalid-feedback">NIP sudah ada dalam basis data.</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <label for="nama" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama" pattern="[a-zA-Z\s]+" class="form-control ps-2 border-0 border-bottom">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                                    <label for="telepon" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="telepon" pattern="[0-9]{5,}" title="Minimal 5 angka" class="form-control ps-2 border-0 border-bottom" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                    <label for="agama" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <select name="agama" id="agama" class="form-select border-0 border-bottom" required>
                                            <option value="">-- Pilih Agama --</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
                                    <label for="alamat" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3" placeholder="alamat siswa" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center px-5">
                                <img src="../assets/img/salinan default.png" class="mb-3" style="width: 40%">
                                <input type="file" name="image" class="form-control form-control-sm mt-4"> <small class="text-secondary">Pilih Foto PNG, JPEG atau JPG maximal 2MB</small>
                                <small class="text-secondary">Widht = height</small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <?php
    require_once "../template/footer.php";
    ?>
</div>