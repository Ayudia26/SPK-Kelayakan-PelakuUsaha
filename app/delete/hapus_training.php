<?php
include('../../conf/config.php');

if (isset($_POST['id_training'])) {
    $id_training = $_POST['id_training'];

    // Protect against SQL injection
    $id_training = mysqli_real_escape_string($koneksi, $id_training);

    // Execute the DELETE query
    $query = mysqli_query($koneksi, "DELETE FROM tb_training WHERE id_training = '$id_training'");

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
