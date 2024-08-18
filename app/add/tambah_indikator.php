<?php
include('../../conf/config.php');

$response = array('success' => false, 'error' => '');

try {
    // Proses file upload
    if ($_FILES['file_upload']['name']) {
        $target_dir = "../uploads/"; // Direktori tempat file akan disimpan
        $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            $response['error'] = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["file_upload"]["size"] > 500000) {
            $response['error'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx" && $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
            $response['error'] = "Sorry, only PDF, DOC, DOCX, JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // Stop further processing if upload failed
        } else {
            if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
                $response['file'] = htmlspecialchars(basename($_FILES["file_upload"]["name"]));
            } else {
                $response['error'] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    if ($uploadOk == 1) {
        $nama_pelaku = $_POST['nama_pelaku'];
        $sertifikat_spp = $_POST['sertifikat_spp'];
        $sertifikat_skp = $_POST['sertifikat_skp'];
        $sertifikat_halal = $_POST['sertifikat_halal'];
        $attg = $_POST['attg'];
        $pemasaran = $_POST['pemasaran'];
        $file_name = $response['file'] ?? '';

        $query = "INSERT INTO tb_indikator (nama_pelaku, sertifikat_spp, sertifikat_skp, sertifikat_halal, attg, pemasaran, file) VALUES ('$nama_pelaku', '$sertifikat_spp', '$sertifikat_skp', '$sertifikat_halal', '$attg', '$pemasaran', '$file_name')";

        if (mysqli_query($koneksi, $query)) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Database error: ' . mysqli_error($koneksi);
        }
    }
} catch (Exception $e) {
    $response['error'] = 'Exception: ' . $e->getMessage();
}

echo json_encode($response);
?>