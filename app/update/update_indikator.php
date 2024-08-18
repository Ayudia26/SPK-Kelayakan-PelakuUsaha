<?php
include('../../conf/config.php');

// Memeriksa apakah semua parameter ada dalam POST
if (isset($_POST['id_indikator'], $_POST['nama_pelaku'], $_POST['sertifikat_skp'], $_POST['sertifikat_spp'], $_POST['sertifikat_halal'], $_POST['attg'], $_POST['pemasaran'])) {
    // Mengambil nilai variabel dari POST
    $id_indikator = $_POST['id_indikator'];
    $nama_pelaku = $_POST['nama_pelaku'];
    $sertifikat_skp = $_POST['sertifikat_skp'];
    $sertifikat_spp = $_POST['sertifikat_spp'];
    $sertifikat_halal = $_POST['sertifikat_halal'];
    $attg = $_POST['attg'];
    $pemasaran = $_POST['pemasaran'];
    
    // Melakukan query UPDATE ke database
    $query = mysqli_query($koneksi, "UPDATE tb_indikator SET nama_pelaku='$nama_pelaku', sertifikat_skp='$sertifikat_skp', sertifikat_spp='$sertifikat_spp', sertifikat_halal='$sertifikat_halal', attg='$attg', pemasaran='$pemasaran' WHERE id_indikator='$id_indikator'");

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
