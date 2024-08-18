<?php
include('../../conf/config.php');

// Memeriksa apakah semua parameter ada dalam URL
if (isset($_GET['id'], $_GET['nama_pelaku'], $_GET['kecamatan'], $_GET['alamat'], $_GET['nama_produk'], $_GET['no_kusuka'], $_GET['status'], $_GET['tanggal'])) {
    // Mengambil nilai variabel dari URL
    $id = $_GET['id'];
    $nama_pelaku = $_GET['nama_pelaku'];
    $kecamatan = $_GET['kecamatan'];
    $alamat = $_GET['alamat'];
    $nama_produk = $_GET['nama_produk'];
    $no_kusuka = $_GET['no_kusuka'];
    $status = $_GET['status'];
    $tanggal = $_GET['tanggal'];

    // Melakukan query INSERT ke database
    $query = mysqli_query($koneksi, "INSERT INTO tb_pelaku (id, nama_pelaku, kecamatan, alamat, nama_produk, no_kusuka, status, tanggal) VALUES('', '$nama_pelaku', '$kecamatan', '$alamat', '$nama_produk', '$no_kusuka', '$status', '$tanggal')");

    // Periksa apakah kueri berhasil atau tidak
    if ($query) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Ada parameter yang kurang dalam URL."]);
}
?>
