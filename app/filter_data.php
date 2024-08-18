<?php
// Assuming $koneksi is your database connection
include('C:/xampp/htdocs/copy8/conf/config.php'); // Adjust the path according to your actual setup

if (isset($_POST['bulan']) && !empty($_POST['bulan'])) {
    $selected_month = $_POST['bulan'];
    $where_condition = "WHERE MONTH(tanggal) = $selected_month";
} else {
    $where_condition = "";
}

$query = mysqli_query($koneksi, "SELECT * FROM tb_testing $where_condition");

$no = 1;
while($plk = mysqli_fetch_array($query)) {
    echo '<tr>';
    echo '<td>' . $no . '</td>';
    echo '<td>' . $plk['id_testing'] . '</td>';
    echo '<td>' . $plk['id_indikator'] . '</td>';
    echo '<td>' . (isset($plk['nama_pelaku']) ? $plk['nama_pelaku'] : '') . '</td>';
    echo '<td>' . (isset($plk['sertifikat_spp']) ? $plk['sertifikat_spp'] : '') . '</td>';
    echo '<td>' . (isset($plk['sertifikat_skp']) ? $plk['sertifikat_skp'] : '') . '</td>';
    echo '<td>' . (isset($plk['sertifikat_halal']) ? $plk['sertifikat_halal'] : '') . '</td>';
    echo '<td>' . (isset($plk['attg']) ? $plk['attg'] : '') . '</td>';
    echo '<td>' . (isset($plk['pemasaran']) ? $plk['pemasaran'] : '') . '</td>';
    echo '<td>' . (isset($plk['kelayakan']) ? $plk['kelayakan'] : '') . '</td>';
    echo '<td>' . (isset($plk['tanggal']) ? $plk['tanggal'] : '') . '</td>';
    echo '<td>';
    echo '<button class="btn btn-sm btn-danger" onclick="hapus_testing(\'' . $plk['id_testing'] . '\', this)">Hapus</button>';
    echo '<a href="index.php?page=edit-testing&&id_testing=' . $plk['id_testing'] . '" class="btn btn-sm btn-success">Edit</a>';
    echo '</td>';
    echo '</tr>';
    $no++;
}
?>
