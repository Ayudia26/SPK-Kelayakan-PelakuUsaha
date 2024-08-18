<?php
// Include database configuration
include('../conf/config.php');

// Check if id_validasi is set and not empty
if(isset($_POST['id_validasi']) && !empty($_POST['id_validasi'])) {
    // Sanitize input to prevent SQL injection
    $id_validasi = mysqli_real_escape_string($koneksi, $_POST['id_validasi']);

    // Update status_verifikasi to 'Terverifikasi'
    $query = "UPDATE tb_validasi SET status_validasi = 'Tervalidasi' WHERE id_validasi = '$id_validasi'";
    
    if(mysqli_query($koneksi, $query)) {
        // Success response
        echo json_encode(array('success' => true, 'message' => 'Status validasi berhasil diperbarui.'));
    } else {
        // Error response
        echo json_encode(array('success' => false, 'error' => 'Gagal memperbarui status validasi: ' . mysqli_error($koneksi)));
    }
} else {
    // Invalid request response
    echo json_encode(array('success' => false, 'error' => 'Invalid request'));
}
?>
