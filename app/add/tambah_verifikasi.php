<?php
include('../../conf/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['tanggal_verifikasi'], $_POST['status_verifikasi'])) {
    $id = $_POST['id'];
    $tanggal_verifikasi = $_POST['tanggal_verifikasi'];
    $status_verifikasi = $_POST['status_verifikasi'];

    // Fetch nama_pelaku from tb_pelaku based on selected id
    $result = mysqli_query($koneksi, "SELECT nama_pelaku FROM tb_pelaku WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
    $nama_pelaku = $row['nama_pelaku'];

    // Insert query without id_verifikasi
    $query = mysqli_query($koneksi, "INSERT INTO tb_verifikasi (id, nama_pelaku, tanggal_verifikasi, status_verifikasi) VALUES ('$id', '$nama_pelaku', '$tanggal_verifikasi', '$status_verifikasi')");

    if ($query) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add verification data', 'error' => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Incomplete data']);
}
?>
