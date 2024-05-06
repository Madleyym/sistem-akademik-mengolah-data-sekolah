<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $pelajaran = $_POST['pelajaran'];
    $kelas = $_POST['kelas'];
    $guru = $_POST['guru'];

    // Periksa apakah pelajaran dan kelas sudah ada sebelumnya atau belum
    $cekPelajaranKelas = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE pelajaran = '$pelajaran' AND kelas = '$kelas'");
    if (mysqli_num_rows($cekPelajaranKelas) > 0) {
        header('location:pelajaran.php?msg=cancel');
        exit;
    }

    // Melakukan proses penyimpanan data
    $insertQuery = "INSERT INTO tbl_pelajaran (pelajaran, kelas, guru) VALUES ('$pelajaran', '$kelas', '$guru')";
    if (mysqli_query($koneksi, $insertQuery)) {
        header('location: pelajaran.php?msg=added');
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $kelas = $_POST['kelas']; 
    $pelajaran = $_POST['pelajaran'];
    $guru = $_POST['guru'];

    // Dapatkan data pelajaran saat ini dari database berdasarkan id
    $queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE id = $id");
    $data = mysqli_fetch_array($queryPelajaran);
    $curPelajaran = $data['pelajaran'];
    $curKelas = $data['kelas'];

    // Periksa apakah pelajaran dan kelas yang baru sudah ada sebelumnya, kecuali untuk data yang sama
    if ($pelajaran !== $curPelajaran || $kelas !== $curKelas) {
        $cekPelajaranKelas = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE pelajaran = '$pelajaran' AND kelas = '$kelas'");
        if (mysqli_num_rows($cekPelajaranKelas) > 0) {
            header('location:pelajaran.php?msg=cancelupdate');
            exit;
        }
    }

    // Melakukan proses update data
    $updateQuery = "UPDATE tbl_pelajaran SET pelajaran = '$pelajaran', kelas = '$kelas', guru = '$guru' WHERE id = $id";
    if (mysqli_query($koneksi, $updateQuery)) {
        header('location: pelajaran.php?msg=updated');
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
