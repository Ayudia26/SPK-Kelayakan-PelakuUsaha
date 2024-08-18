<?php
include('../../conf/config.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = array('success' => false);

try {
    // Check if all required POST variables are set
    if (isset($_POST['id_testing']) && isset($_POST['kelayakan'])) {
        $id_testing = $_POST['id_testing'];
        $kelayakan = $_POST['kelayakan'];

        // Retrieve nama_pelaku based on id_testing
        $query_nama_pelaku = mysqli_query($koneksi, "SELECT nama_pelaku FROM tb_testing WHERE id_testing = '$id_testing'");
        $row_nama_pelaku = mysqli_fetch_assoc($query_nama_pelaku);
        $nama_pelaku = $row_nama_pelaku['nama_pelaku'];

        // Determine the value of hasil based on kelayakan
        if (strtolower($kelayakan) === 'layak') {
            $hasil = '<b>Siap dipromosikan</b>';
        } else if (strtolower($kelayakan) === 'tidak layak') {
            $hasil = '<b style="color:red;">Perlu dibina kembali</b>';
        } else {
            $response['error'] = 'Kelayakan tidak valid';
            echo json_encode($response);
            exit;
        }

        // Insert into the database
        $query_insert = mysqli_query($koneksi, "INSERT INTO tb_hasil (id_testing, nama_pelaku, kelayakan, hasil) VALUES ('$id_testing', '$nama_pelaku', '$kelayakan', '$hasil')");

        if ($query_insert) {
            $response['success'] = true;
        } else {
            $response['error'] = mysqli_error($koneksi);
        }
    } else {
        $response['error'] = 'Input tidak lengkap';
    }
} catch (Exception $e) {
    $response['error'] = 'Exception: ' . $e->getMessage();
}

// Mengatur header untuk response JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
