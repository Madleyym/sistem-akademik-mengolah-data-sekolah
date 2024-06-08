<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $noUjian = htmlspecialchars($_POST['noUjian']);
    $tgl = htmlspecialchars($_POST['tgl']);
    $nis = htmlspecialchars($_POST['nis']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $sum = htmlspecialchars($_POST['sum']);
    $min = htmlspecialchars($_POST['min']);
    $max = htmlspecialchars($_POST['max']);
    $avg = htmlspecialchars($_POST['avg']);

    // Periksa apakah NIS sudah ada dalam database
    $queryCheckNIS = "SELECT COUNT(*) AS count FROM tbl_ujian WHERE nis = '$nis'";
    $resultCheckNIS = mysqli_query($koneksi, $queryCheckNIS);
    $rowCheckNIS = mysqli_fetch_assoc($resultCheckNIS);

    if ($rowCheckNIS['count'] > 0) {
        // Jika NIS sudah digunakan, tampilkan pesan dan kembali ke halaman sebelumnya
        $msg = "NIS sudah digunakan. Silakan gunakan NIS yang lain.";
        header("location:nilai-ujian.php?msg=$msg&nis=$nis");
        exit;
    }

    // Hitung hasil ujian berdasarkan nilai
    if ($min < 50 || $avg < 60) {
        $hasilUjian = "GAGAL";
    } else {
        $hasilUjian = "LULUS";
    }

    $mapel = $_POST['mapel'];
    $nilai = $_POST['nilai'];


    mysqli_query($koneksi, "INSERT INTO tbl_ujian VALUES('$noUjian', '$tgl', '$nis', '$kelas', $sum, $min, $max, $avg, '$hasilUjian')");

    foreach ($mapel as $key => $mpl) {
        $nilaiUjian = $nilai[$key];
        mysqli_query($koneksi, "INSERT INTO tbl_nilai_ujian (no_ujian, pelajaran, nilai_ujian) 
                                VALUES ('$noUjian', '$mpl', $nilaiUjian)");
    }

    // Redirect ke halaman nilai-ujian dengan pesan hasil dan NIS
    header("location:nilai-ujian.php?msg=$hasilUjian&nis=$nis");
    exit;
}
?>
