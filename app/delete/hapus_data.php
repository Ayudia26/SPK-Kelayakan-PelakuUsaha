<?php
include('../../conf/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Melakukan query DELETE ke database
    $query = mysqli_query($koneksi, "DELETE FROM tb_pelaku WHERE id = '$id'");

    // Periksa apakah kueri berhasil atau tidak
    if ($query) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID tidak ditemukan dalam URL."]);
}
?>
