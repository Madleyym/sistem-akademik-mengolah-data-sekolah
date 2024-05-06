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
    <i class="fa-solid fa-circle-check"></i> Data Guru berhasil diupdate.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'cancel') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-xmark"></i> Gagal mengupdate data Guru, NIP sudah ada.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">GURU</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Guru</li>
            </ol>
            <!-- Menampilkan notifikasi di sini -->
            <?php if ($alert !== '') {
                echo $alert;
            } ?>
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
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> DATA GURU</span>
                    <a href="<?= $main_url ?>guru/add-guru.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-user-plus"></i> TAMBAH GURU</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-center" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>No</center>
                                </th>
                                <th scope="col">
                                    <center>Foto</center>
                                </th>
                                <th scope="col">
                                    <center>NIP</center>
                                </th>
                                <th scope="col">
                                    <center>Nama</center>
                                </th>
                                <th scope="col">
                                    <center>Telepon</center>
                                </th>
                                <th scope="col">
                                    <center>Agama</center>
                                </th>
                                <th scope="col">
                                    <center>Alamat</center>
                                </th>
                                <th scope="col">
                                    <center>Operasi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
                            while ($data = mysqli_fetch_array($queryGuru)) {
                            ?>
                                <tr>
                                    <td align="center"><?= $no++ ?></td>
                                    <td align="center">
                                        <img src="../assets/img/<?= $data['foto'] ?>" class="rounded-circle" alt="foto guru" width="60px">
                                    </td>
                                    <td align="center"><?= $data['nip'] ?></td>
                                    <td align="center"><?= $data['nama'] ?></td>
                                    <td align="center"><?= $data['telepon'] ?></td>
                                    <td align="center"><?= $data['agama'] ?></td>
                                    <td align="center"><?= $data['alamat'] ?></td>
                                    <td align="center">
                                        <a href="edit-guru.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning" title="update guru"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <button type="button" class="btn btn-sm btn-danger" title="delete guru" id="btnHapus" data-id="<?= $data['id'] ?>" data-foto="<?= $data['foto'] ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </main>
    <!-- modal hapus data -->
    <div class="modal" id="mdlHapus" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="" id="btnMdlHapus" class="btn btn-primary">Ya</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', "#btnHapus", function() {
                $('#mdlHapus').modal('show');
                let idGuru = $(this).data('id');
                let fotoGuru = $(this).data('foto');
                $('#btnMdlHapus').attr("href", "hapus-guru.php?id=" + idGuru + "&foto=" + fotoGuru);
            });
        });
    </script>


    <?php

    require_once "../template/footer.php";

    ?>