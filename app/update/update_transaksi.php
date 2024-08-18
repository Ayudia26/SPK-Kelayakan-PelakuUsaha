<?php
include('../../conf/config.php');

// Memeriksa apakah semua parameter ada dalam POST
if (isset($_POST['id_transaksi'], $_POST['id'], $_POST['nama_pelaku'], $_POST['nama_produk'], $_POST['volume_produk'], $_POST['omset'], $_POST['tanggal'])) {
    // Mengambil nilai variabel dari POST
    $id_transaksi = $_POST['id_transaksi'];
    $id = $_POST['id'];
    $nama_pelaku = $_POST['nama_pelaku'];
    $nama_produk = $_POST['nama_produk'];
    $volume_produk = $_POST['volume_produk'];
    $omset = $_POST['omset'];
    $tanggal = $_POST['tanggal'];

    // Melakukan query UPDATE ke database
    $query = mysqli_query($koneksi, "UPDATE tb_transaksi SET id='$id', nama_pelaku='$nama_pelaku', nama_produk='$nama_produk', volume_produk='$volume_produk', omset='$omset', tanggal='$tanggal' WHERE id_transaksi='$id_transaksi'");

    // Periksa apakah kueri berhasil atau tidak
    if ($query) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Ada parameter yang kurang dalam POST."]);
}
?>
