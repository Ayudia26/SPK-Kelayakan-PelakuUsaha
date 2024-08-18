<?php
include('../../conf/config.php');

// Memeriksa apakah semua parameter ada dalam POST
if (isset($_POST['id_testing'], $_POST['id_indikator'], $_POST['nama_pelaku'], $_POST['sertifikat_spp'], $_POST['sertifikat_skp'], $_POST['sertifikat_halal'], $_POST['attg'], $_POST['pemasaran'], $_POST['kelayakan'], $_POST['tanggal'])) {
    // Mengambil nilai variabel dari POST
    $id_testing = $_POST['id_testing'];
    $id_indikator = $_POST['id_indikator'];
    $nama_pelaku = $_POST['nama_pelaku'];
    $sertifikat_spp = $_POST['sertifikat_spp'];
    $sertifikat_skp = $_POST['sertifikat_skp'];
    $sertifikat_halal = $_POST['sertifikat_halal'];
    $attg = $_POST['attg'];
    $pemasaran = $_POST['pemasaran'];
    $kelayakan = $_POST['kelayakan'];
    $tanggal = $_POST['tanggal'];

    // Melakukan query UPDATE ke database
    $query = mysqli_query($koneksi, "UPDATE tb_testing SET id_indikator='$id_indikator', nama_pelaku='$nama_pelaku', sertifikat_spp='$sertifikat_spp', sertifikat_skp='$sertifikat_skp', sertifikat_halal='$sertifikat_halal', attg='$attg', pemasaran='$pemasaran', kelayakan='$kelayakan', tanggal='$tanggal' WHERE id_testing='$id_testing'");

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
