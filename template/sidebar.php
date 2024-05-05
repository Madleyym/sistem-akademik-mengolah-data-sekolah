<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion bg-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Home</div>
                    <a class="nav-link" href="<?= $main_url ?>index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        DASHBOARD
                    </a>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Admin</div>
                    <a class="nav-link" href="<?= $main_url ?>user/add-user.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        USER
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>user/password.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-key"></i></div>
                        GANTI PASSWORD
                    </a>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Data</div>
                    <a class="nav-link" href="<?= $main_url ?>siswa/siswa.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        SISWA
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>guru/guru.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        GURU
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>pelajaran/pelajaran.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                        MATA PELAJARAN
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>ujian/ujian.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        UTS / UAS
                    </a>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">JADWAL & ABSENSI</div>
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>#">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        ABSENSI SISWA
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>#">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        JADWAL PELAJARAN
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>#">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        JADWAL UTS / UAS
                    </a>
                    <hr class="mb-0">
                </div>
            </div>
            <div class="sb-sidenav-footer" style="background-color: navbar-dark bg-dark;">
                <div class="small">Logged in as:</div>
                <?= "Admin" ?>
            </div>
        </nav>
    </div>