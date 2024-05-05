<?php
require_once "../config.php";

$kelas = $_GET['kelas'];

$no = 1;
$queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE kelas = '$kelas'");

// Periksa apakah query berhasil dieksekusi
if ($queryPelajaran) {
    // Lakukan iterasi dan tampilkan hasil query
    while ($data = mysqli_fetch_array($queryPelajaran)) {


?>
        <tr>
            <td align="center"><?= $no++ ?></td>
            <td><input type="text" name="kelas[]" value="<?= $kelas ?>" class="border-0 bg-transparent col-12" readonly></td>
            <td><input type="text" name="mapel[]" value="<?= $data['pelajaran'] ?>" class="border-0 bg-transparent col-12" readonly></td>

            <td><input type="number" name="nilai[]" value="0" min="0" max="100" step="5" class="form-control nilai text-center" onchange="fnhitung()"></td>
        </tr>
<?php
    }
} else {
    // Tampilkan pesan kesalahan jika query gagal dieksekusi
    echo "Error: " . mysqli_error($koneksi);
}
?>