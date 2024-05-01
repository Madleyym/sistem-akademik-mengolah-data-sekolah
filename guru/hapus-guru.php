<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}
require_once "../config.php";

$id = $_GET['id'];
$foto = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM tbl_guru WHERE id = '$id'");
if ($foto != 'Salinan default.png') {
    unlink("../assets/img/" . $foto);
}
header('location:guru.php?msg=deleted');
return;
