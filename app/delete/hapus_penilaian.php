<?php
include('../../conf/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_penilaian'])) {
    $id_penilaian = $_POST['id_penilaian'];

    // Protect against SQL injection
    $id_penilaian = mysqli_real_escape_string($koneksi, $id_penilaian);

    // Execute the DELETE query
    $query = mysqli_query($koneksi, "DELETE FROM tb_penilaian WHERE id_penilaian = '$id_penilaian'");

    // Check if the query was successful
    if ($query) {
        echo json_encode(["success" => true]);
    } else {
        $error = mysqli_error($koneksi);
        error_log("Deletion error: " . $error);  // Log errors
        echo json_encode(["success" => false, "error" => $error]);
    }
} else {
    $error = "Parameter id_penilaian tidak ditemukan atau metode request tidak valid.";
    error_log($error);  // Log errors
    echo json_encode(["success" => false, "error" => $error]);
}
?>
