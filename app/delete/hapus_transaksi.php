<?php
include('../../conf/config.php');

if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Melakukan query DELETE ke database
    $query = mysqli_query($koneksi, "DELETE FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'");

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
