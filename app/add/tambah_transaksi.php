<?php
include('../../conf/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_transaksi'], $_POST['id'], $_POST['nama_pelaku'], $_POST['nama_produk'], $_POST['volume_produk'], $_POST['omset'], $_POST['tanggal'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id = $_POST['id'];
    $nama_pelaku = $_POST['nama_pelaku'];
    $nama_produk = $_POST['nama_produk'];
    $volume_produk = $_POST['volume_produk'];
    $omset = $_POST['omset'];
    $tanggal = $_POST['tanggal'];

    // Query to add data to the database
    $query = mysqli_query($koneksi, "INSERT INTO tb_transaksi (id_transaksi, id, nama_pelaku, nama_produk, volume_produk, omset, tanggal) VALUES ('$id_transaksi', '$id', '$nama_pelaku', '$nama_produk', '$volume_produk', '$omset', '$tanggal')");

    if ($query) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add transaction data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Incomplete data']);
}
?>
