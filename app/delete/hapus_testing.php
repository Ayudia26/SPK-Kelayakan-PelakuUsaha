<?php
include('../../conf/config.php');

header('Content-Type: application/json');

if (isset($_POST['id_testing'])) {
    $id_testing = $_POST['id_testing'];

    // Protect against SQL injection
    $id_testing = mysqli_real_escape_string($koneksi, $id_testing);

    // Execute the DELETE query
    $query = mysqli_query($koneksi, "DELETE FROM tb_testing WHERE id_testing = '$id_testing'");

    // Check if the query was successful
    if ($query) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID not found in POST data."]);
}
?>
