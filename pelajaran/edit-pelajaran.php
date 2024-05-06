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

$id = $_GET['id'];
$querypelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE id = $id");
$data = mysqli_fetch_array($querypelajaran);
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">UPDATE MATA PELAJARAN</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="pelajaran.php">Back</a></li>
            </ol>
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <span class="h5 my-2"><i class="fa-solid fa-pen-to-square"></i> Edit Pelajaran</span>
                        </div>
                        <div class="card-body">
                            <form action="proses-pelajaran.php" method="POST">
                                <input type="number" name="id" value="<?= $data['id'] ?>" hidden>
                                <div class="mb-3">
                                    <label for="pelajaran" class="form-label ps-1">Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="pelajaran" name="pelajaran" placeholder="nama pelajaran" value="<?= $data['pelajaran'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="guru" class="form-label ps-1">Guru</label>
                                    <select name="guru" id="guru" class="form-select" required>
                                        <?php
                                        $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
                                        while ($dataGuru = mysqli_fetch_array($queryGuru)) {
                                            if ($data['guru'] == $dataGuru['nama']) {
                                                echo '<option value="' . $dataGuru['nama'] . '" selected>' . $dataGuru['nama'] . '</option>';
                                            } else {
                                                echo '<option value="' . $dataGuru['nama'] . '">' . $dataGuru['nama'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary mt-2" name="update"><i class="fa-solid fa-pen"></i> UPDATE</button>
                                <button type="reset" class="btn btn-sm btn-danger mt-2"><i class="fa-solid fa-xmark"></i> CANCEL</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
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
                            <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Siswa</span>
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
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['pelajaran'] ?></td>
                                        <td><?= $data['guru'] ?></td>
                                        <td align="center">
                                            <a href="edit-pelajaran.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning" title="Edit Pelajaran"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td align="center">
                                            <button type="button" data-id="<?= $data['id'] ?>" id="btnHapus" class="btn btn-sm btn-danger" title="Hapus Pelajaran"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once "../template/footer.php"; ?>