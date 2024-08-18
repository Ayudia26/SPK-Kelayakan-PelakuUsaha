<?php
include('../../conf/config.php');

// Memeriksa apakah semua parameter ada dalam POST
if (isset($_POST['id_training'], $_POST['id'], $_POST['nama_pelaku'], $_POST['sertifikat_spp'], $_POST['sertifikat_skp'], $_POST['sertifikat_halal'], $_POST['attg'], $_POST['pemasaran'], $_POST['tanggal'], $_POST['kelayakan'])) {
    // Mengambil nilai variabel dari POST
    $id_training = $_POST['id_training'];
    $id = $_POST['id'];
    $nama_pelaku = $_POST['nama_pelaku'];
    $sertifikat_spp = $_POST['sertifikat_spp'];
    $sertifikat_skp = $_POST['sertifikat_skp'];
    $sertifikat_halal = $_POST['sertifikat_halal'];
    $attg = $_POST['attg'];
    $pemasaran = $_POST['pemasaran'];
    $tanggal = $_POST['tanggal'];
    $kelayakan = $_POST['kelayakan'];

    // Melakukan query UPDATE ke database
    $query = mysqli_query($koneksi, "UPDATE tb_training SET id='$id', nama_pelaku='$nama_pelaku', sertifikat_spp='$sertifikat_spp', sertifikat_skp='$sertifikat_skp', sertifikat_halal='$sertifikat_halal', attg='$attg', pemasaran='$pemasaran', tanggal='$tanggal', kelayakan='$kelayakan' WHERE id_training='$id_training'");

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
