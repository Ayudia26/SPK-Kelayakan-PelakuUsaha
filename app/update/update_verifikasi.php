<?php
include('../../conf/config.php');

// Memeriksa apakah semua parameter ada dalam POST
if (isset($_POST['id_verifikasi'], $_POST['id'], $_POST['nama_pelaku'], $_POST['tanggal_verifikasi'], $_POST['status_verifikasi'])) {
    // Mengambil nilai variabel dari POST
    $id_verifikasi = $_POST['id_verifikasi'];
    $id = $_POST['id'];
    $nama_pelaku = $_POST['nama_pelaku'];
    $tanggal_verifikasi = $_POST['tanggal_verifikasi'];
    $status_verifikasi = $_POST['status_verifikasi'];

    // Melakukan query UPDATE ke database
    $query = mysqli_query($koneksi, "UPDATE tb_verifikasi SET id='$id', nama_pelaku='$nama_pelaku', tanggal_verifikasi='$tanggal_verifikasi', status_verifikasi='$status_verifikasi' WHERE id_verifikasi='$id_verifikasi'");

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
