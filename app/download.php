<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Sanitize the file parameter to prevent directory traversal attacks
    $file = basename($file);

    // Tentukan path file yang akan didownload
    $filePath = 'files/' . $file;

    // Debugging: echo file path
    echo "Trying to download: " . $filePath . "<br>";

    if (file_exists($filePath)) {
        // Tentukan headers untuk proses download
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Flush sistem output buffer
        readfile($filePath); // Baca file dan kirim ke output buffer
        exit;
    } else {
        echo "File not found: " . $filePath;
    }
} else {
    echo "No file specified.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download File</title>
    <script>
        function downloadFile(fileName) {
            // Redirect ke download.php dengan parameter file
            window.location.href = 'download.php?file=' + fileName;
        }
    </script>
</head>
<body>
    <h1>Download File</h1>
    <button id="downloadButton" onclick="downloadFile('example.xlsx')">Download Excel File</button>
</body>
</html>
