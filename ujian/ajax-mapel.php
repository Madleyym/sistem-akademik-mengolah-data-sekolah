<?php
require_once "../config.php";

if (isset($_GET['kelas'])) {
    $kelas = $_GET['kelas'];

    $queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE kelas = '$kelas'");

    if ($queryPelajaran) {
        $no = 1;
        while ($data = mysqli_fetch_array($queryPelajaran)) {
            echo '<tr>
                <td align="center">' . $no++ . '</td>
                <td><input type="text" name="kls[]" value="' . $kelas . '" class="border-0 bg-transparent col-12 text-center" readonly></td>
                <td><input type="text" name="mapel[]" value="' . $data['pelajaran'] . '" class="border-0 bg-transparent col-12 text-center" readonly></td>
                <td><input type="number" name="nilai[]" value="0" min="0" max="100" step="5" class="form-control nilai text-center" onchange="fnhitung()"></td>
            </tr>';
        }
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
