<?php

require_once "../config.php";

// Pastikan $_GET['nis'] ada sebelum digunakan
if (isset($_GET['nis'])) {
    // Mengambil NIS dari parameter GET
    $nis = $_GET['nis'];

    // Membuat kueri SQL untuk memilih pelajaran berdasarkan NIS
    $queryPelajaran = mysqli_query($koneksi, "SELECT pelajaran FROM tbl_pelajaran WHERE id_siswa = (
        SELECT id FROM tbl_siswa WHERE nis = '$nis'
    )");

    // Periksa apakah kueri berhasil dieksekusi
    if ($queryPelajaran) {
        // Periksa apakah ada data yang ditemukan
        if (mysqli_num_rows($queryPelajaran) > 0) {
            $no = 1;
            // Loop melalui hasil kueri dan tampilkan data
            while ($data = mysqli_fetch_array($queryPelajaran)) { ?>
                <tr>
                    <td align="center"><?= $no++ ?></td> <!-- Menampilkan nomor urut -->
                    <td> <input type="text" name="mapel[]" value="<?= $data['pelajaran'] ?>" class="border-0 bg-transparent col-12" readonly></td>
                    <td> <input type="number" name="nilai[]" value="0" min="0" max="100" class="form-control nilai text-center"></td>
                </tr>
<?php }
        } else {
            // Tampilkan pesan jika tidak ada data yang ditemukan
            echo "<tr><td colspan='3'>Data pelajaran tidak ditemukan untuk siswa dengan NIS $nis</td></tr>";
        }
    } else {
        // Tampilkan pesan jika kueri gagal dieksekusi
        echo "<tr><td colspan='3'>Terjadi kesalahan dalam mengambil data</td></tr>";
    }
} else {
    // Tampilkan pesan jika NIS tidak ditemukan dalam parameter GET
    echo "<tr><td colspan='3'>NIS tidak ditemukan</td></tr>";
}
?>