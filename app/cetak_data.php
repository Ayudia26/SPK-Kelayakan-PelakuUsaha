<?php
require 'vendor/autoload.php'; // Pastikan dompdf terinstall melalui composer

use Dompdf\Dompdf;

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include your configuration file
include('../../conf/config.php');

// Retrieve metrics from session
$accuracy = isset($_SESSION['accuracy']) ? $_SESSION['accuracy'] : 82;
$precision = isset($_SESSION['precision']) ? $_SESSION['precision'] : 0;
$recall = isset($_SESSION['recall']) ? $_SESSION['recall'] : 0;

// Query untuk mendapatkan data dari database
$query = mysqli_query($koneksi, "SELECT * FROM tb_testing");

$html = '<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .kop-surat { text-align: center; margin-bottom: 20px; }
        .kop-surat img { width: 100px; }
        .kop-surat h2 { margin: 0; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        .metrics { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="path/to/logo.png" alt="Logo">
        <h2>Nama Instansi</h2>
        <p>Alamat Instansi</p>
    </div>
    <h3>Data Testing</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelaku Usaha</th>
                <th>Sertifikat SPP-IRT</th>
                <th>Sertifikat SKP</th>
                <th>Sertifikat Halal</th>
                <th>ATTG</th>
                <th>Jangkauan Pemasaran</th>
                <th>Kelayakan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>';

$no = 1;
while($plk = mysqli_fetch_array($query)){
    $html .= '<tr>
        <td>' . $no . '</td>
        <td>' . $plk['nama_pelaku'] . '</td>
        <td>' . $plk['sertifikat_spp'] . '</td>
        <td>' . $plk['sertifikat_skp'] . '</td>
        <td>' . $plk['sertifikat_halal'] . '</td>
        <td>' . $plk['attg'] . '</td>
        <td>' . $plk['pemasaran'] . '</td>
        <td>' . $plk['kelayakan'] . '</td>
        <td>' . $plk['tanggal'] . '</td>
    </tr>';
    $no++;
}

$html .= '</tbody>
    </table>
    <div class="metrics">
        <p>Akurasi: ' . round($accuracy, 2) . '% | Precision: ' . round($precision, 2) . '% | Recall: ' . round($recall, 2) . '%</p>
    </div>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("data_testing.pdf", array("Attachment" => 0));
?>
