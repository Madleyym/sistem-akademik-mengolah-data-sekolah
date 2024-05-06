<?php
session_start();
if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";


if (isset($_POST['simpan'])) {
    $noUjian = htmlspecialchars($_POST['noUjian']);
    $tgl = htmlspecialchars($_POST['tgl']);
    $nis = htmlspecialchars($_POST['nis']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $sum = htmlspecialchars($_POST['sum']);
    $min = htmlspecialchars($_POST['min']);
    $max = htmlspecialchars($_POST['max']);
    $avg = htmlspecialchars($_POST['avg']);

    if($min < 50 or $avg < 60){
     $hasilUjian = "GAGAL";

    } else{
        $hasilUjian = "LULUS";
    }

  $mapel = $_POST['mapel'];
  $kls = $_POST['kls'];
  $nilai = $_POST['nilai'];

  mysqli_query($koneksi, "INSERT INTO tbl_ujian VALUES('$noUjian', '$tgl', '$nis', '$kelas', $sum, $min, $max, $avg, '$hasilUjian')");

  foreach($mapel as $key => $mpl){
    mysqli_query($koneksi, "INSERT INTO tbl_nilai_ujian (no_ujian, pelajaran, nilai_ujian) 
                            VALUES ('$noUjian', '$mpl', {$nilai[$key]})");
  }


  header("location:nilai-ujian.php?msg=$hasilUjian&nis=$nis"); 
  return;


}


?>