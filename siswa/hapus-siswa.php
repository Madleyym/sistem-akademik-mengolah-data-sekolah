<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";
$id = $_GET['nis'];
$foto = $_GET['foto'];

mysqli_query($koneksi, "DELETE FROM tbl_siswa WHERE nis = '$id'");
if ($foto != null) {
    unlink("../assets/img/siswa/" . $foto);
}
echo "
<script>
alert('Data Berhasil diHapus');
document.location.href = 'siswa.php';
</script>";
header("location:siswa.php");
return;
