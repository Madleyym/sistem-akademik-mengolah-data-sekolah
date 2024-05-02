<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}
require_once "../config.php";

$title = "Pelajaran - SDN 3 KUJANGSARI";

require_once "../template/header.php";
require_once "../template/sidebar.php";
require_once "../template/navbar.php";

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mata Pelajaran</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Mata Pelajaran</li>
            </ol>
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-plus"></i> Tambah Pelajaran
                        </div>
                        <div class="card-body">
                            <!-- <form action="proses-pelajaran.php" method="POST"></form> -->
                            <form action="">
                                <div class="mb-3">
                                    <label for="pelajaran" class="form-label">Pelajaran</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8"></div>
            </div>
        </div>
    </main>
    <?php

    require_once "../template/footer.php";

    ?>