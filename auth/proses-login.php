
<?php

require_once "../index.php";



// jika tombol ditekan
if (isset($_POST['login'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    // Cari pengguna berdasarkan nama pengguna menggunakan prepared statement
    $result = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

    // Periksa apakah ada setidaknya satu baris yang ditemukan
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            header("location:../index.php");
            exit;
        } else {
            // Kata sandi tidak sesuai, tampilkan pesan kesalahan
            echo "<script>
                alert('Username atau password salah');
                document.location.href = 'login.php';
                </script>";
        }
    } else {
        // Tidak ada pengguna dengan nama pengguna yang diberikan, tampilkan pesan kesalahan
        echo "<script>
            alert('Username tidak terdaftar');
            document.location.href = 'login.php';
            </script>";
    }
}
?>
