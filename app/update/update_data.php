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

    // Melakukan query UPDATE ke database
    $query = mysqli_query($koneksi, "UPDATE tb_pelaku SET nama_pelaku='$nama_pelaku', kecamatan='$kecamatan', alamat='$alamat', nama_produk='$nama_produk', no_kusuka='$no_kusuka', status='$status', tanggal='$tanggal' WHERE id='$id'");

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
