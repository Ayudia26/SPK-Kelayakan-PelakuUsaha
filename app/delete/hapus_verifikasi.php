<?php
include('../../conf/config.php'); // Ensure this path is correct

if (isset($_POST['id_verifikasi'])) {
    $id_verifikasi = $_POST['id_verifikasi'];

    // Melakukan query DELETE ke database
    $query = mysqli_query($koneksi, "DELETE FROM tb_verifikasi WHERE id_verifikasi = '$id_verifikasi'");

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
