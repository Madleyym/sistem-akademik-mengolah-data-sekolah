<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}


require_once "../config.php";

// jika tombol disimpan
if (isset($_POST['simpan'])) {
    // ambil nilai yang diposting
    $id         = $_POST['id'];
    $nama       = trim(htmlspecialchars($_POST['nama']));
    $email      = trim(htmlspecialchars($_POST['email']));
    $status     = $_POST['status'];
    $akreditasi = $_POST['akreditasi'];
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $visimisi   = trim(htmlspecialchars($_POST['visimisi']));
    $gbr        = trim(htmlspecialchars($_POST['gbrLama']));

    // lakukan pembaruan data

    // cek gambar
    if ($_FILES['img']['error'] === 4) {
        $gbrSekolah = $gbr;
    } else {
        // Jika file gambar diupload
        $url = 'profile-sekolah.php'; // URL tempat upload gambar
        // Fungsi uploadimg() harus didefinisikan
        $gbrSekolah = uploadimg($url); // Anda perlu menentukan fungsi uploadimg()
        @unlink('../assets/img/' . $gbr);
        // @unlink('../assets/img/' . $data['gambar']); //chatGPT
    }
    // update data
    mysqli_query($koneksi, "UPDATE tbl_sekolah SET 
                                    nama = '$nama', 
                                    email = '$email', 
                                    status = '$status', 
                                    akreditasi = '$akreditasi', 
                                    alamat = '$alamat', 
                                    visimisi = '$visimisi', 
                                    gambar = '$gbrSekolah' 
                                    WHERE id = $id");
    header("location:profile-sekolah.php?msg=updated");
    return;
}
