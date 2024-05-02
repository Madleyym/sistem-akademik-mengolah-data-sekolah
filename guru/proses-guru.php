<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}
require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['simpan'])) {
        $nip     = htmlspecialchars($_POST['nip']);
        $nama    = htmlspecialchars($_POST['nama']);
        $telepon = htmlspecialchars($_POST['telepon']);
        $agama   = $_POST['agama'];
        $alamat  = htmlspecialchars($_POST['alamat']);
        $foto    = $_FILES['image']['name'];

        $cekNip = mysqli_query($koneksi, "SELECT * FROM tbl_guru WHERE nip = '$nip'");
        if (mysqli_num_rows($cekNip) > 0) {
            header('location:add-guru.php?msg=cancel');
            exit;
        }

        if (!empty($foto)) {
            $url = "add-guru.php";
            $foto = uploadimg($url);
        } else {
            $foto = "Salinan default.png";
        }

        mysqli_query($koneksi, "INSERT INTO tbl_guru VALUES(null,'$nip', '$nama', '$alamat', '$telepon', '$agama', '$foto')");
        header('location:add-guru.php?msg=added');
        return;
    } else if (isset($_POST['update'])) {
        $id      = $_POST['id'];
        $nip     = htmlspecialchars($_POST['nip']);
        $nama    = htmlspecialchars($_POST['nama']);
        $telepon = htmlspecialchars($_POST['telepon']);
        $agama   = $_POST['agama'];
        $alamat  = htmlspecialchars($_POST['alamat']);
        $foto    = $_FILES['image']['name'];

        if ($_FILES['image']['error'] === 4) {
            $fotoGuru = $_POST['fotoLama'];
        } else {
            $url = "add-guru.php";
            $fotoGuru = uploadimg($url);
        }

        $sqlGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru WHERE id = '$id'");
        $data = mysqli_fetch_array($sqlGuru);
        $curNIP = $data['nip'];

        if ($nip !== $curNIP) {
            $newNIP = mysqli_query($koneksi, "SELECT * FROM tbl_guru WHERE nip = '$nip'");
            if (mysqli_num_rows($newNIP) > 0) {
                header('location:add-guru.php?msg=cancel');
                return;
            }
        }

        if ($foto != 'Salinan default.png') {
            unlink("../assets/img/" . $foto);
        }

        mysqli_query($koneksi, "UPDATE tbl_guru SET nip = '$nip', nama = '$nama', alamat = '$alamat', telepon = '$telepon', agama = '$agama', foto = '$fotoGuru' WHERE id = '$id'");
        header('location:guru.php?msg=updated');
        return;
    }
}
