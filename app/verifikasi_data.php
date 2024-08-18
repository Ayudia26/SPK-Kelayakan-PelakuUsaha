<?php
// Include database configuration
include('../conf/config.php');

// Check if id_verifikasi is set and not empty
if(isset($_POST['id_verifikasi']) && !empty($_POST['id_verifikasi'])) {
    // Sanitize input to prevent SQL injection
    $id_verifikasi = mysqli_real_escape_string($koneksi, $_POST['id_verifikasi']);

    // Update status_verifikasi to 'Terverifikasi'
    $query = "UPDATE tb_verifikasi SET status_verifikasi = 'Terverifikasi' WHERE id_verifikasi = '$id_verifikasi'";
    
    if(mysqli_query($koneksi, $query)) {
        // Success response
        echo json_encode(array('success' => true, 'message' => 'Status verifikasi berhasil diperbarui.'));
    } else {
        // Error response
        echo json_encode(array('success' => false, 'error' => 'Gagal memperbarui status verifikasi: ' . mysqli_error($koneksi)));
    }
} else {
    // Invalid request response
    echo json_encode(array('success' => false, 'error' => 'Invalid request'));
}
?>
