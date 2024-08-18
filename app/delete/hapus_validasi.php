<?php
include('../../conf/config.php');

if (isset($_POST['id_validasi'])) {
    $id_validasi = mysqli_real_escape_string($koneksi, $_POST['id_validasi']);
    
    // Proses penghapusan berdasarkan id_validasi
    $query = "DELETE FROM tb_validasi WHERE id_validasi = '$id_validasi'";
    
    if (mysqli_query($koneksi, $query)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID Validasi tidak ditemukan dalam data POST."]);
}
?>
