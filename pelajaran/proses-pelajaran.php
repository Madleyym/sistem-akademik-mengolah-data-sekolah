<?php

session_start();
require_once "../config.php";

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}
if (isset($_POST['simpan'])) {
    $pelajaran = $_POST['pelajaran'];
    $guru = $_POST['guru'];

    // Periksa apakah pelajaran sudah ada sebelumnya atau belum
    $cekPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE pelajaran = '$pelajaran'");
    if (mysqli_num_rows($cekPelajaran) > 0) {
        header('location:pelajaran.php?msg=cancel');
        return;
    }

    //melakukan proses penyimpanan data
    mysqli_query($koneksi, "INSERT INTO tbl_pelajaran VALUES (null,'$pelajaran', '$guru')");
    header('location: pelajaran.php?msg=added');
    return;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $pelajaran = $_POST['pelajaran'];
    $guru = $_POST['guru'];

    $queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE id = $id");
    $data = mysqli_fetch_array($queryPelajaran);
    $curPelajaran = $data['pelajaran'];

    $cekPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE pelajaran = '$pelajaran'");

    if ($pelajaran !== $curPelajaran) {
        if (mysqli_num_rows($cekPelajaran) > 0) {
            header('location:pelajaran.php?msg=cancelupdate');
            return;
        }
    }

    mysqli_query($koneksi, "UPDATE tbl_pelajaran SET pelajaran = '$pelajaran', guru = '$guru' WHERE id = $id");

    header('location: pelajaran.php?msg=updated');
    return;
}
