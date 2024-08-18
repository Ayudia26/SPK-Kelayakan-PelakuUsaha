<?php
include('../../conf/config.php');

// Memeriksa apakah semua parameter ada dalam POST
if (isset($_POST['id_validasi'], $_POST['id_verifikasi'], $_POST['tanggal_validasi'], $_POST['status_validasi'], $_POST['keterangan'])) {
    // Mengambil nilai variabel dari POST
    $id_validasi = $_POST['id_validasi'];
    $id_verifikasi = $_POST['id_verifikasi'];
    $tanggal_validasi = $_POST['tanggal_validasi'];
    $status_validasi = $_POST['status_validasi'];
    $keterangan = $_POST['keterangan'];
  
    
    // Melakukan query UPDATE ke database
    $query = mysqli_query($koneksi, "UPDATE tb_validasi SET id_verifikasi='$id_verifikasi', tanggal_validasi='$tanggal_validasi', status_validasi='$status_validasi', keterangan='$keterangan' WHERE id_validasi='$id_validasi'");

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
