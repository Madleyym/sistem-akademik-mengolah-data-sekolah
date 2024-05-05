<?php

session_start();

if (isset($_SESSION['ssLogin'])) {
    header("location:../index.php");
    exit;
}

require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi login sesuai dengan logika aplikasi Anda
    // Contoh sederhana: cek apakah username dan password adalah 'admin'
    if ($username === "admin" && $password === "admin") {
        // Jika login berhasil, set session dan arahkan ke halaman index.php
        $_SESSION['ssLogin'] = true;
        header("location:../index.php");
        exit;
    } else {
        // Jika login gagal, berikan pesan kesalahan atau tindakan lainnya
        // Misalnya, tampilkan pesan error atau arahkan kembali ke halaman login
        $error_message = "Username atau password salah. Silakan coba lagi.";
    }
}

$sekolah = mysqli_query($koneksi, "SELECT * FROM tbl_sekolah WHERE id = 1"); // Perbaikan penulisan WHERE
$data = mysqli_fetch_array($sekolah);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SDN 3 KUJANGSARI</title>

    <style>
        body {
            overflow: hidden;
            /* Matikan scroll */
        }

        .form {
            background-color: #ffffff;
            box-shadow: 10px 10px 0px 1px rgba(82, 137, 220, 1);
            -webkit-box-shadow: 10px 10px 0px 1px rgba(82, 137, 220, 1);
            -moz-box-shadow: 10px 10px 0px 1px rgba(82, 137, 220, 1);
            justify-content: space-between;
            width: 415px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            border: 1px solid #568CDD;
        }

        .copyright {
            text-align: center;
            color: #808080;
            font-size: small;
        }

        .konten {
            min-height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #e8f5fc;
        }

        h2 {
            font-size: 35px;
            color: #548BDD;
            text-align: center;
            margin-top: 50px;
        }

        input {
            background-color: #E8F5FC;
            outline: none;
            border: none;
        }

        button {
            background-color: #568CDD;
            width: 360px;
            height: 41px;
            margin: auto;
            outline: 1px solid #548BDD;
            border-left: none;
            border-top: none;
            border-right: none;
            border-bottom: none;
            color: white;
            margin-bottom: 100px;
            cursor: pointer;
        }

        .username,
        .password {
            border: 1px solid #548BDD;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #558BDD;
            background-color: #E8F5FC;
            width: 350px;
            height: 41px;
            justify-content: left;
            margin: 0px auto;
            gap: 5px;
            padding-left: 10px;
        }
    </style>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/effca873af.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="konten">
        <form action="proses-login.php" class="form" method="POST">
            <h2>L O G I N</h2>
            <?php if (isset($error_message)) : ?>
                <div style="color: red; text-align: center;"><?= $error_message ?></div>
            <?php endif; ?>
            <div class="username">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" id="username" placeholder="username" pattern="[A-Za-z0-9]{3,}" title="minimal 3 karakter" autocomplete="off" required />
            </div>
            <div class="password">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="password" id="inputPassword" placeholder="password">
            </div>
            <button type="submit" name="login">LOGIN</button>
            <p class="copyright">Copyright &copy; SDN 3 KUJANGSARI <?= date("Y") ?></p>
        </form>
    </div>
</body>

</html>