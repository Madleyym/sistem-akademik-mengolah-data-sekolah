<?php
session_start();
if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['no_ujian'])) {
    $no_ujian = $_POST['no_ujian'];

    // Lakukan penghapusan data ujian berdasarkan no_ujian
    $deleteQuery = "DELETE FROM tbl_ujian WHERE no_ujian = '$no_ujian'";
    if (mysqli_query($koneksi, $deleteQuery)) {
        // Setelah berhasil menghapus, siapkan pesan
        $msg = "Data berhasil dihapus";
        // Redirect kembali ke halaman ujian.php dengan membawa pesan
        header("location:ujian.php?msg=$msg");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
