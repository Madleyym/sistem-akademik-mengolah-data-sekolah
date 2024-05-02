<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}
require_once "../config.php";

$title = "Pelajaran - SDN 3 KUJANGSARI";

require_once "../template/header.php";
require_once "../template/sidebar.php";
require_once "../template/navbar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = "";
}
$alert = '';

// Tambahkan notifikasi sesuai dengan pesan yang diterima
if ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" id="added" role="alert">
    <i class="fa-solid fa-circle-check"></i> Tambah pelajaran berhasil.
  </div>';
}
if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" id="added" role="alert">
    <i class="fa-solid fa-circle-check"></i> Pelajaran berhasil di hapus.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'cancel') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-xmark"></i> Tambah Pelajaran Gagal, Mata Pelajaran sudah ada.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mata Pelajaran</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Mata Pelajaran</li>
            </ol>
            <?php
            if ($msg !== '') {
                echo $alert;
            }
            ?>
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-plus"></i> Tambah Pelajaran
                        </div>
                        <div class="card-body">
                            <form action="proses-pelajaran.php" method="POST">
                                <div class="mb-3">
                                    <label for="pelajaran" class="form-label ps-1">Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="pelajaran" name="pelajaran" placeholder="nama pelajaran" required>
                                </div>
                                <div class="mb-3">
                                    <label for="guru" class="form-label ps-1">Guru</label>
                                    <select name="guru" id="guru" class="form-select" required>
                                        <option value="" selected>-- Pilih Guru --</option>
                                        <?php
                                        $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
                                        while ($dataGuru = mysqli_fetch_array($queryGuru)) {
                                            // Bagian di bawah ini adalah bagian yang diulang di setiap iterasi loop while
                                            echo '<option value="' . $dataGuru['nama'] . '">' . $dataGuru['nama'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary mt-2" name="simpan"><i class="fa-solid fa-floppy-disk"></i> SIMPAN</button>
                                <button type="reset" class="btn btn-sm btn-danger mt-2" name="reset"><i class="fa-solid fa-xmark"></i> RESET</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-list"></i> Data Pelajaran
                        </div>
                        <div class="card-body">
                            <table class="table table-hover text-center" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <center>No</center>
                                        </th>
                                        <th scope="col">
                                            <center>Mata Pelajaran</center>
                                        </th>
                                        <th scope="col">
                                            <center>Nama Guru</center>
                                        </th>
                                        <th scope="col">
                                            <center>Edit</center>
                                        </th>
                                        <th scope="col">
                                            <center>Hapus</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran");
                                    while ($data = mysqli_fetch_array($queryPelajaran)) { ?>


                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $data['pelajaran'] ?></td>
                                            <td><?= $data['guru'] ?></td>
                                            <td align="center"> <!-- Perbaikan disini -->
                                                <a href="#" class="btn btn-sm btn-warning" title="Edit Pelajaran"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <!-- <button type="button" id="btnHapus" class="btn btn-sm btn-danger" title="Hapus Pelajaran"><i class="fa-solid fa-trash"></i></button> -->
                                            <td align="center">
                                                <!-- <a href="#" class="btn btn-sm btn-warning" title="Edit Pelajaran"><i class="fa-solid fa-pen-to-square"></i></a> -->
                                                <button type="button" data-id="<?= $data['id'] ?>" id="btnHapus" class="btn btn-sm btn-danger" title="Hapus Pelajaran"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

    <!-- timeOut Jquery punya java -->
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btnHapus', function() {
                $('#mdlHapus').modal('show');
                let id = $(this).data('id');
                $('#btnMdlHapus').attr('href', 'hapus-pelajaran.php?id=' + id);
            });
            setTimeout(function() {
                $('#added').fadeIn('slow'); // Menggunakan fadeIn, bukan fadein
            }, 300);

            setTimeout(function() {
                $('#added').fadeOut('slow'); // Menempatkan fungsi fadeOut dalam setTimeout agar hanya dijalankan setelah 30000 ms
            }, 3000);
        });
    </script>

    <?php

    require_once "../template/footer.php";

    ?>