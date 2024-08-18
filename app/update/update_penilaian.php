<?php
include('../../conf/config.php');

// Log data POST untuk debugging
error_log(print_r($_POST, true));

if (isset($_POST['id_penilaian'], $_POST['indikator'], $_POST['nilai'], $_POST['keterangan'])) {
    $id_penilaian = $_POST['id_penilaian'];
    $indikator = $_POST['indikator'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];

    // Query untuk memperbarui data di database
    $query = mysqli_query($koneksi, "UPDATE tb_penilaian SET indikator='$indikator', keterangan='$keterangan', nilai='$nilai' WHERE id_penilaian='$id_penilaian'");

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
