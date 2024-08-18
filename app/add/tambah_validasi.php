<?php
include('../../conf/config.php');

$id_validasi = $_POST['id_validasi'];
$id_verifikasi = $_POST['id_verifikasi'];
$tanggal_validasi = $_POST['tanggal_validasi'];
$status_validasi = $_POST['status_validasi'];
$keterangan = $_POST['keterangan'];

$query = "INSERT INTO tb_validasi (id_validasi, id_verifikasi, tanggal_validasi, status_validasi, keterangan) VALUES ('$id_validasi', '$id_verifikasi', '$tanggal_validasi', '$status_validasi', '$keterangan')";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($koneksi)]);
}
?>