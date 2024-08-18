<?php
include('../../conf/config.php');

if (isset($_GET['id_indikator'])) {
    $id_indikator = $_GET['id_indikator'];

    // Melakukan query DELETE ke database
    $query = mysqli_query($koneksi, "DELETE FROM tb_indikator WHERE id_indikator = '$id_indikator'");

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
