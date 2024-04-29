<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}
require_once "../config.php";

// jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // ambil value element yang di posting
    $nama       = trim(htmlspecialchars($_POST['nama']));
    $username   = trim(htmlspecialchars($_POST['username']));
    $jabatan    = $_POST['jabatan'];
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $gambar     = ($_FILES['image']['name']);
    $password   = '1234';
    $pass       = password_hash($password, PASSWORD_DEFAULT);

    // cek username
    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0) {
        header("location:add-user.php?msg=cancel");
        return;
    }
    // uplode gambar 
    if ($gambar != null) {
        $url = 'add-user.php';
        $gambar = uploadimg($url);
    } else {
        $gambar = 'salinan default.png';
    }

    mysqli_query($koneksi, "INSERT INTO tbl_user (username, password, nama, alamat, jabatan, foto) VALUES ('$username', '$pass', '$nama', '$alamat', '$jabatan', '$gambar')");

    header("location:add-user.php?msg=added");
    return;
}
