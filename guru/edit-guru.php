<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Guru - SDN 3 KUJANGSARI";

require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$id = $_GET['id'];
$queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru WHERE id = '$id'");
$data = mysqli_fetch_array($queryGuru);

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Guru</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item "><a href="guru.php">Guru</a></li>
                <li class="breadcrumb-item active">Update Guru</li>
            </ol>
            <form method="post" action="proses-guru.php" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i> Update Guru</span>
                        <button type="submit" name="update" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-pen-to-square"></i> UPDATE</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <div class="row mb-3">
                                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                                    <label for="nip" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nip" pattern="[0-9]{18,}" title="NIP harus 18 angka" class="form-control ps-2 border-0 border-bottom" value="<?= $data['nip'] ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <label for="nama" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama" pattern="[a-zA-Z\s]+" class="form-control ps-2 border-0 border-bottom" value="<?= $data['nama'] ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                                    <label for="telepon" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="telepon" pattern="[0-9]{5,}" title="Minimal 5 angka" class="form-control ps-2 border-0 border-bottom" value="<?= $data['telepon'] ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                    <label for="agama" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <select name="agama" id="agama" class="form-select border-0 border-bottom" required>
                                            <?php
                                            $agama = ['islam', 'kristen', 'katolik', 'hindu', 'budha'];
                                            foreach ($agama as $rgl) {
                                                if ($data['agama'] == $rgl) {
                                            ?>
                                                    <option value="<?= $rgl ?>" selected><?= $rgl ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $rgl ?>"><?= $rgl ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
                                    <label for="alamat" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3" placeholder="alamat siswa" class="form-control" required><?= $data['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center px-5">
                                <input type="hidden" name="fotoLama" value="<?= $data['foto'] ?>">
                                <img src="../assets/img/<?= $data['foto'] ?>" class="mb-3 rounded-circle" width="40%">
                                <input type="file" name="image" class="form-control form-control-sm mt-4"> <small class="text-secondary">Pilih Foto PNG, JPEG atau JPG maximal 2MB</small>
                                <small class="text-secondary">Widht = height</small>
                                <div>
                                </div>
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