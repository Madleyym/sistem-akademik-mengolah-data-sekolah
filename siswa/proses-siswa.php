<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}
require_once "../config.php";

if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = htmlspecialchars($_POST['nama']);
    $kelas = $_POST['kelas'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $foto = $_FILES['image']['name']; // Mengambil nama file gambar yang diunggah
    $foto_tmp = $_FILES['image']['tmp_name']; // Mengambil file gambar yang diunggah sementara

    if ($foto != null) {
        $url = "add-siswa.php";
        $destination = "../assets/img/" . $foto; // Tentukan lokasi tujuan untuk menyimpan gambar
        move_uploaded_file($foto_tmp, $destination); // Pindahkan file gambar yang diunggah ke lokasi tujuan
    } else {
        $foto = 'Salinan default.png';
    }

    // Menjalankan query SQL dengan mysqli_query
    $result = mysqli_query($koneksi, "INSERT INTO tbl_siswa (nis, nama, alamat, kelas, foto) VALUES ('$nis','$nama','$alamat','$kelas','$foto')");

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        echo "<script>
            alert('Data Berhasil diSimpan');
            document.location.href = 'add-siswa.php';
        </script>";
    } else {
        // Menangani perubahan data siswa
        $query = "UPDATE tbl_siswa SET nama = '$nama', alamat = '$alamat', kelas = '$kelas'";
        if ($foto != null) {
            $query .= ", foto = '$foto'"; // Tambahkan kondisi untuk mengubah foto jika ada
        }
        $query .= " WHERE nis = '$nis'";
        mysqli_query($koneksi, $query);

        echo "<script>
            alert('Data Berhasil diUpdate');
            document.location.href = 'siswa.php';
        </script>";
        return;
    }
} else  if (isset($_POST['update'])) {
    $nis    = $_POST['nis'];
    $nama   = htmlspecialchars($_POST['nama']);
    $kelas   = $_POST['kelas'];
    $alamat =  htmlspecialchars($_POST['alamat']);
    $foto = htmlspecialchars($_POST['image']['name']); // Mengambil nama file gambar yang diunggah
    // $foto_tmp = $_FILES['image']['tmp_name']; // Mengambil file gambar yang diunggah sementara

    if ($_FILES['image']['error'] === 4) {
        $fotoSiswa = $foto;
    } else {
        $url = "siswa.php";
        $fotoSiswa = uploadimg($url);
        if ($foto != 'Salinan default.png') {
            @unlink("../assets/img/ . $foto");
        }
        mysqli_query($koneksi, "UPDATE tbl_siswa SET foto = '$fotoSiswa' WHERE nis = '$nis'");
    }
    mysqli_query($koneksi, "UPDATE tbl_siswa SET nama = '$nama', alamat = '$alamat', kelas = '$kelas' WHERE nis = '$nis'");
    header("location: siswa.php");

    echo "<script>
        alert('Data Berhasil diUpdate');
        document.location.href = 'siswa.php';
    </script>";
}
