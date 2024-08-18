<?php
include('../../conf/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true)); // Log data yang diterima untuk debugging
    if (isset($_POST['id_penilaian'], $_POST['indikator'], $_POST['keterangan'], $_POST['nilai'])) {
        $id_penilaian = $_POST['id_penilaian'];
        $indikator = $_POST['indikator'];
        $keterangan = $_POST['keterangan'];
        $nilai = $_POST['nilai'];

        // Query to add data to the database
        $query = mysqli_query($koneksi, "INSERT INTO tb_penilaian (id_penilaian, indikator, keterangan, nilai) VALUES ('$id_penilaian', '$indikator', '$keterangan', '$nilai')");

        if ($query) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add transaction data: ' . mysqli_error($koneksi)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Incomplete data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
