<?php

session_start();
// $title = "Siswa - SDN 3 KUJANGSARI";
if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}
require_once "../config.php";
if (isset($_POST['simpan'])) {
    $nip     = htmlspecialchars($_POST['nip']);
    $nama    = htmlspecialchars($_POST['nama']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $agama   = $_POST['agama'];
    $alamat  = htmlspecialchars($_POST['alamat']);
    $foto    = htmlspecialchars($_FILES['image']['name']);


    $cekNip = mysqli_query($koneksi, "SELECT * FROM tbl_guru WHERE nip = '$nip'");
    if (mysqli_num_rows($cekNip) > 0) {
        // Jika NIP sudah ada, tampilkan pesan kesalahan
        header('location:add-guru.php?msg=cancel');
        exit; // Hentikan proses penambahan data
    }

    if ($foto != null) {
        $url = "add-guru.php";
        $foto = uploadimg($url);
    } else {
        $foto = "Salinan default.png";
    }
    mysqli_query($koneksi, "INSERT INTO tbl_guru VALUES(null,'$nip', '$nama', '$alamat', '$telepon', '$agama', '$foto')");
    header('location:add-guru.php?msg=added');
    return;
}
?>

<!-- // require_once "../template/header.php"; -->
<!-- // require_once "../template/navbar.php";
// require_once "../template/sidebar.php";



// require_once "../template/footer.php";

// -->