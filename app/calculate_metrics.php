<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session if not already started
}

include('../../conf/config.php'); // Sesuaikan path file konfigurasi sesuai dengan struktur proyek Anda

// Ambil data dari tb_testing dan tb_training
$query_testing = mysqli_query($koneksi, "SELECT * FROM tb_testing");
$query_training = mysqli_query($koneksi, "SELECT * FROM tb_training");

$testing_data = [];
$training_data = [];

// Memasukkan data tb_testing ke dalam array
while ($row = mysqli_fetch_assoc($query_testing)) {
    $testing_data[] = $row;
}

// Memasukkan data tb_training ke dalam array
while ($row = mysqli_fetch_assoc($query_training)) {
    $training_data[] = $row;
}

// Tentukan jumlah data untuk testing dan training
$total_data_testing = count($testing_data);
$total_data_training = count($training_data);

// Hitung berapa banyak data yang akan digunakan untuk testing (40%)
$percent_testing = 0.4; // 40% untuk testing
$count_testing = round($total_data_testing * $percent_testing);

// Ambil data testing dari tb_testing
$data_testing = array_slice($testing_data, 0, $count_testing);

// Ambil data training dari tb_training
$data_training = $training_data; // Seluruh data tb_training digunakan untuk training

// Proses penghitungan akurasi, precision, dan recall
$total_data = count($data_testing);

// Inisialisasi variabel untuk perhitungan layak dan tidak layak
$correct_predictions_layak = 0;
$true_positives_layak = 0;
$false_positives_layak = 0;
$false_negatives_layak = 0;

$correct_predictions_tidak_layak = 0;
$true_positives_tidak_layak = 0;
$false_positives_tidak_layak = 0;
$false_negatives_tidak_layak = 0;

foreach ($data_testing as $test_row) {
    // Cari data training yang sesuai dengan id_testing pada tb_testing
    $matched_training_data = array_filter($data_training, function($train_row) use ($test_row) {
        return $train_row['id_testing'] == $test_row['id_testing'];
    });

    // Ambil hanya satu data yang sesuai (asumsi hanya ada satu yang cocok)
    $train_row = reset($matched_training_data);

    if ($train_row) {
        if ($test_row['kelayakan'] == 'layak') {
            // Hitung prediksi benar atau salah untuk kelas layak
            if ($test_row['kelayakan'] == $train_row['kelayakan']) {
                $correct_predictions_layak++;
            }
            // Hitung precision dan recall untuk kelas layak
            if ($test_row['kelayakan'] == 'layak' && $train_row['prediksi'] == 'layak') {
                $true_positives_layak++;
            } elseif ($test_row['kelayakan'] == 'tidak layak' && $train_row['prediksi'] == 'layak') {
                $false_positives_layak++;
            } elseif ($test_row['kelayakan'] == 'layak' && $train_row['prediksi'] == 'tidak layak') {
                $false_negatives_layak++;
            }
        } else {
            // Hitung prediksi benar atau salah untuk kelas tidak layak
            if ($test_row['kelayakan'] == $train_row['kelayakan']) {
                $correct_predictions_tidak_layak++;
            }
            // Hitung precision dan recall untuk kelas tidak layak
            if ($test_row['kelayakan'] == 'tidak layak' && $train_row['prediksi'] == 'tidak layak') {
                $true_positives_tidak_layak++;
            } elseif ($test_row['kelayakan'] == 'layak' && $train_row['prediksi'] == 'tidak layak') {
                $false_positives_tidak_layak++;
            } elseif ($test_row['kelayakan'] == 'tidak layak' && $train_row['prediksi'] == 'layak') {
                $false_negatives_tidak_layak++;
            }
        }
    }
}

// Hitung akurasi untuk layak dan tidak layak
if ($total_data > 0) {
    $accuracy_layak = ($correct_predictions_layak / $total_data) * 100;
    $accuracy_tidak_layak = ($correct_predictions_tidak_layak / $total_data) * 100;
} else {
    $accuracy_layak = 0;
    $accuracy_tidak_layak = 0;
}

// Hitung precision untuk layak dan tidak layak
if (($true_positives_layak + $false_positives_layak) > 0) {
    $precision_layak = ($true_positives_layak / ($true_positives_layak + $false_positives_layak)) * 100;
} else {
    $precision_layak = 0;
}

if (($true_positives_tidak_layak + $false_positives_tidak_layak) > 0) {
    $precision_tidak_layak = ($true_positives_tidak_layak / ($true_positives_tidak_layak + $false_positives_tidak_layak)) * 100;
} else {
    $precision_tidak_layak = 0;
}

// Hitung recall untuk layak dan tidak layak
if (($true_positives_layak + $false_negatives_layak) > 0) {
    $recall_layak = ($true_positives_layak / ($true_positives_layak + $false_negatives_layak)) * 100;
} else {
    $recall_layak = 0;
}

if (($true_positives_tidak_layak + $false_negatives_tidak_layak) > 0) {
    $recall_tidak_layak = ($true_positives_tidak_layak / ($true_positives_tidak_layak + $false_negatives_tidak_layak)) * 100;
} else {
    $recall_tidak_layak = 0;
}

// Simpan nilai metrik ke dalam session
$_SESSION['accuracy_layak'] = $accuracy_layak;
$_SESSION['accuracy_tidak_layak'] = $accuracy_tidak_layak;
$_SESSION['precision_layak'] = $precision_layak;
$_SESSION['precision_tidak_layak'] = $precision_tidak_layak;
$_SESSION['recall_layak'] = $recall_layak;
$_SESSION['recall_tidak_layak'] = $recall_tidak_layak;

// Redirect ke halaman data_testing.php
header("Location: data_testing.php");
exit();
?>
