<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN HASIL UJIAN</title>
    <style>
        /* CSS untuk memposisikan judul di tengah halaman */
        h2 {
            text-align: center;
        }

        /* CSS untuk mengatur konten */
        body {
            margin: 1.5cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        @media print {
            @page {
                size: A4;
            }
        }
    </style>
</head>

<body>

    <h2>LAPORAN HASIL UJIAN</h2>


    <table>
        <thead>
            <tr>
                <th>NO UJIAN</th>
                <th>NIS</th>
                <th>NILAI TERENDAH</th>
                <th>NILAI TERTINGGI</th>
                <th>NILAI RATA-RATA</th>
                <th>HASIL UJIAN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $queryUjian = mysqli_query($koneksi, "SELECT * FROM tbl_ujian");
            while ($data = mysqli_fetch_array($queryUjian)) { ?>
                <tr>
                    <td><?= $data['no_ujian'] ?></td>
                    <td><?= $data['nis'] ?></td>
                    <td><?= $data['nilai_terendah'] ?></td>
                    <td><?= $data['nilai_tertinggi'] ?></td>
                    <td><?= $data['nilai_rata2'] ?></td>
                    <td><?= $data['hasil_ujian'] ?></td>
                </tr>
            <?php
            } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    Banjar, <?= date('d F Y'); ?><br>
                    Dibuat oleh, <b>Dewan Guru UPTD SDN 3 KUJANGSARI</b>
                </td>
            </tr>
        </tfoot>
    </table>

    <script>
        // Function untuk menangani pencetakan
        function printDocument() {
            var paperSize = document.getElementById('paperSize').value;
            var style = document.createElement('style');
            style.innerHTML = `@page { size: ${paperSize}; }`;
            document.head.appendChild(style);
            window.print();
            document.head.removeChild(style); // Menghapus style setelah mencetak
        }
    </script>

    <!-- <button onclick="printDocument()">Pratinjau dan Cetak Laporan</button>

    <script>
        // Function untuk menangani pencetakan
        function printDocument() {
            var paperSize = document.getElementById('paperSize').value;
            var style = document.createElement('style');
            style.innerHTML = `@page { size: ${paperSize}; }`;

            // Tambahkan style langsung ke tombol cetak
            var printButton = document.querySelector('button');
            printButton.style.display = 'none';

            document.head.appendChild(style);
            window.print();
            document.head.removeChild(style); // Menghapus style setelah mencetak

            // Kembalikan tampilan tombol cetak setelah pencetakan selesai
            printButton.style.display = 'block';
        }
    </script> -->


</body>

</html>