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

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">DATA UTS UAS</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Data Ujian</li>
            </ol>
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-list"></i> Data Ujian
                    <a href="nilai-ujian.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i>TAMBAH DATA UJIAN</a>
                    <!-- <a href="add-ujian.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i>TAMBAH DATA UJIAN</a> -->
                </div>
                <div class="card-body">
                    <table class="table table-hover text-center" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>NO UJIAN</center>
                                </th>
                                <th scope="col">
                                    <center>NAMA SISWA</center>
                                </th>
                                <th scope="col">
                                    <center>Mata Pelajaran</center>
                                </th>
                                <th scope="col">
                                    <center>KELAS</center>
                                </th>
                                <th scope="col">
                                    <center>Nilai UTS</center>
                                </th>
                                </th>
                                <th scope="col">
                                    <center>Nilai UAS</center>
                                </th>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php
    require_once "../template/footer.php";
    ?>