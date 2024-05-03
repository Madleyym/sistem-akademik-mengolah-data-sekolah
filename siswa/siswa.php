<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}
require_once "../config.php";

$title = "Siswa - SDN 3 KUJANGSARI";

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
            <h1 class="mt-4">SISWA</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Siswa</li>
            </ol>
            <!-- Menampilkan notifikasi di sini -->
            <?php
            if ($msg !== '') {
                echo $alert;
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Siswa</span>
                    <a href="<?= $main_url ?>siswa/add-siswa.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-user-plus"></i> TAMBAH SISWA</a>
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
                                    <center>NIS</center>
                                </th>
                                <th scope="col">
                                    <center>Nama</center>
                                </th>
                                <th scope="col">
                                    <center>Kelas</center>
                                </th>
                                <th scope="col">
                                    <center>Alamat</center>
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
                            $querySiswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa");
                            while ($data = mysqli_fetch_array($querySiswa)) { ?>
                                <tr>
                                    <td align="center"><?= $no++ ?></td>

                                    <td align="center">
                                        <img src="../assets/img/<?= $data['foto'] ?>" class="rounded-circle" alt="foto siswa" width="60px">
                                    </td>
                                    <td align="center"><?= $data['nis'] ?></td>
                                    <td align="center"><?= $data['nama'] ?></td>
                                    <td align="center"><?= $data['kelas'] ?></td>
                                    <td align="center"><?= $data['alamat'] ?></td>
                                    <td align="center">
                                        <a href="edit-siswa.php?nis=<?= $data['nis'] ?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square" title="Update Siswa"></i></a>
                                    </td>
                                    <td align="center">
                                        <a href="Hapus-siswa.php?nis=<?= $data['nis'] ?>&foto=<?= $data['foto'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa-solid fa-trash" title="Hapus Siswa"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php
    require_once "../template/footer.php";
    ?>