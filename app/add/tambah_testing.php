<?php
// Include your configuration file
include('../../conf/config.php');

// Function to train Naive Bayes model
function train_naive_bayes($training_data) {
    $model = [];
    $class_counts = [];
    $total_records = count($training_data);
    
    foreach ($training_data as $record) {
        $class = $record['kelayakan'];
        if (!isset($class_counts[$class])) {
            $class_counts[$class] = 0;
        }
        $class_counts[$class]++;
        
        foreach ($record as $attribute => $value) {
            if ($attribute == 'kelayakan' || $attribute == 'id_training') continue;
            if (!isset($model[$attribute])) {
                $model[$attribute] = [];
            }
            if (!isset($model[$attribute][$value])) {
                $model[$attribute][$value] = [];
            }
            if (!isset($model[$attribute][$value][$class])) {
                $model[$attribute][$value][$class] = 0;
            }
            $model[$attribute][$value][$class]++;
        }
    }

    // Calculate probabilities with Laplace smoothing
    foreach ($model as $attribute => &$values) {
        $unique_values_count = count(array_keys($values));
        foreach ($values as &$class_counts) {
            foreach ($class_counts as $class => &$count) {
                if ($class == 'tidak layak') {
                    $count = ($count + 5) / ($class_counts[$class] + 5 * $unique_values_count);
                } else {
                    $count = ($count + 1) / ($class_counts[$class] + $unique_values_count);
                }
            }
        }
    }

    // Calculate class probabilities
    foreach ($class_counts as &$count) {
        $count /= $total_records;
    }
    
    return [$model, $class_counts];
}

// Function to predict using Naive Bayes model
function predict_naive_bayes($model, $class_probs, $record) {
    $best_class = null;
    $max_prob = -1;
    
    foreach ($class_probs as $class => $class_prob) {
        $prob = $class_prob;
        
        foreach ($record as $attribute => $value) {
            if (isset($model[$attribute][$value][$class])) {
                $prob *= $model[$attribute][$value][$class];
            } else {
                $prob *= 0.001;
            }
        }
        
        if ($prob > $max_prob) {
            $max_prob = $prob;
            $best_class = $class;
        }
    }
    
    return $best_class;
}

// Check if the request is POST and required data exists
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_testing'], $_POST['id_indikator'], $_POST['nama_pelaku'], $_POST['sertifikat_spp'], $_POST['sertifikat_skp'], $_POST['sertifikat_halal'], $_POST['attg'], $_POST['pemasaran'], $_POST['tanggal'])) {
    // Assign POST data to variables
    $id_testing = $_POST['id_testing'];
    $id_indikator = $_POST['id_indikator'];
    $nama_pelaku = $_POST['nama_pelaku'];
    $sertifikat_spp = $_POST['sertifikat_spp'];
    $sertifikat_skp = $_POST['sertifikat_skp'];
    $sertifikat_halal = $_POST['sertifikat_halal'];
    $attg = $_POST['attg'];
    $pemasaran = $_POST['pemasaran'];
    $tanggal = $_POST['tanggal'];

    // Fetch indicator data from tb_indikator table
    $query_indikator = mysqli_query($koneksi, "SELECT * FROM tb_indikator WHERE id_indikator = '$id_indikator'");
    $indikator = mysqli_fetch_array($query_indikator);
    
    if (!$indikator) {
        echo json_encode(["success" => false, "message" => "Indikator not found for id_indikator = $id_indikator"]);
        exit;
    }

    // Prepare and execute INSERT statement into tb_testing table
    $stmt = $koneksi->prepare("INSERT INTO tb_testing (id_testing, id_indikator, nama_pelaku, sertifikat_spp, sertifikat_skp, sertifikat_halal, attg, pemasaran, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $id_testing, $id_indikator, $nama_pelaku, $sertifikat_spp, $sertifikat_skp, $sertifikat_halal, $attg, $pemasaran, $tanggal);

    if ($stmt->execute()) {
        $inserted_id = $stmt->insert_id;

        // Retrieve newly inserted data from tb_testing table
        $result = mysqli_query($koneksi, "SELECT * FROM tb_testing WHERE id_testing = $inserted_id");
        $plk = mysqli_fetch_array($result);

        // Prepare test record for prediction
        $test_record = [
            'id_testing' => $plk['id_testing'],
            'id_indikator' => $plk['id_indikator'],
            'nama_pelaku' => $plk['nama_pelaku'],
            'sertifikat_spp' => $plk['sertifikat_spp'],
            'sertifikat_skp' => $plk['sertifikat_skp'],
            'sertifikat_halal' => $plk['sertifikat_halal'],
            'attg' => $plk['attg'],
            'pemasaran' => $plk['pemasaran']
        ];

        // Retrieve training data from tb_training table
        $training_data = [];
        $query = mysqli_query($koneksi, "SELECT * FROM tb_training");
        while ($plk = mysqli_fetch_array($query)) {
            $training_data[] = [
                'id_training' => $plk['id_training'],
                'nama_pelaku' => $plk['nama_pelaku'],
                'sertifikat_spp' => $plk['sertifikat_spp'],
                'sertifikat_skp' => $plk['sertifikat_skp'],
                'sertifikat_halal' => $plk['sertifikat_halal'],
                'attg' => $plk['attg'],
                'pemasaran' => $plk['pemasaran'],
                'kelayakan' => $plk['kelayakan'],
            ];
        }

        // Train Naive Bayes model
        list($model, $class_probs) = train_naive_bayes($training_data);

        // Predict kelayakan for the new record
        $predicted_kelayakan = predict_naive_bayes($model, $class_probs, $test_record);

        // Determine hasil based on predicted_kelayakan
        if ($predicted_kelayakan == 'Layak') {
            $hasil = 'Siap dipromosikan';
        } elseif ($predicted_kelayakan == 'Tidak Layak') {
            $hasil = 'Perlu dibina kembali';
        } else {
            $hasil = 'Belum Diketahui'; // Handle any other case if necessary
        }

        // Update the new record with the predicted kelayakan and hasil
        $update_query = "UPDATE tb_testing SET kelayakan = '$predicted_kelayakan' WHERE id_testing = $inserted_id";
        mysqli_query($koneksi, $update_query);

        $update_hasil_query = "INSERT INTO tb_hasil (id_testing, kelayakan, hasil, nama_pelaku) 
        VALUES ('$id_testing', '$predicted_kelayakan', '$hasil', '$nama_pelaku')
        ON DUPLICATE KEY UPDATE id_testing = '$id_testing', kelayakan = '$predicted_kelayakan', hasil = '$hasil', nama_pelaku = '$nama_pelaku'";
    mysqli_query($koneksi, $update_hasil_query);
    

        // Prepare JSON response
        $response = [
            "success" => true,
            "message" => "Data successfully inserted and processed",
            "kelayakan" => $predicted_kelayakan,
            "hasil" => $hasil
        ];
        echo json_encode($response);

    } else {
        echo json_encode(["success" => false, "message" => "Failed to insert data into tb_testing"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
