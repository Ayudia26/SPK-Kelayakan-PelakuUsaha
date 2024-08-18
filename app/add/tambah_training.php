<?php
include('../../conf/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_training'], $_POST['id'], $_POST['sertifikat_spp'], $_POST['sertifikat_skp'], $_POST['sertifikat_halal'], $_POST['attg'], $_POST['pemasaran'], $_POST['tanggal'], $_POST['kelayakan'])) {
    $id_training = $_POST['id_training'];
    $id = $_POST['id'];
    $sertifikat_spp = $_POST['sertifikat_spp'];
    $sertifikat_skp = $_POST['sertifikat_skp'];
    $sertifikat_halal = $_POST['sertifikat_halal'];
    $attg = $_POST['attg'];
    $pemasaran = $_POST['pemasaran'];
    $tanggal = $_POST['tanggal'];
    $kelayakan = $_POST['kelayakan'];

    // Fetch nama_pelaku from tb_pelaku based on selected id
    $result = mysqli_query($koneksi, "SELECT nama_pelaku FROM tb_pelaku WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
    $nama_pelaku = $row['nama_pelaku'];

    // Use prepared statements to prevent SQL injection
    $stmt = $koneksi->prepare("INSERT INTO tb_training (id_training, id, nama_pelaku, sertifikat_spp, sertifikat_skp, sertifikat_halal, attg, pemasaran, tanggal, kelayakan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $id_training, $id, $nama_pelaku, $sertifikat_spp, $sertifikat_skp, $sertifikat_halal, $attg, $pemasaran, $tanggal, $kelayakan);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Data berhasil ditambahkan"]);
    } else {
        echo json_encode(["success" => false, "message" => "Data gagal ditambahkan"]);
    }

    $stmt->close();
    $koneksi->close();
} else {
    echo json_encode(["success" => false, "message" => "Incomplete data"]);
}
?>
