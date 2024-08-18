<?php
// Fungsi untuk melatih model Naive Bayes
function train_naive_bayes($training_data) {
    $model = [];
    $total_records = count($training_data);
    $class_counts = [];
    
    foreach ($training_data as $record) {
        $class = $record['kelayakan'];
        if (!isset($class_counts[$class])) {
            $class_counts[$class] = 0;
        }
        $class_counts[$class]++;
        
        foreach ($record as $attribute => $value) {
            if ($attribute == 'kelayakan') continue;
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
    
    foreach ($model as $attribute => &$values) {
        foreach ($values as &$class_counts) {
            foreach ($class_counts as $class => &$count) {
                $count /= $class_counts[$class];
            }
        }
    }
    
    foreach ($class_counts as &$count) {
        $count /= $total_records;
    }
    
    return [$model, $class_counts];
}

// Fungsi untuk memprediksi menggunakan model Naive Bayes
function predict_naive_bayes($model, $class_probs, $record) {
    $max_prob = -1;
    $best_class = null;
    
    foreach ($class_probs as $class => $class_prob) {
        $prob = $class_prob;
        foreach ($record as $attribute => $value) {
            if (isset($model[$attribute][$value][$class])) {
                $prob *= $model[$attribute][$value][$class];
            } else {
                $prob = 0;
            }
        }
        if ($prob > $max_prob) {
            $max_prob = $prob;
            $best_class = $class;
        }
    }
    
    return $best_class;
}

// Ambil data training dari database
$training_data = [];
$query = mysqli_query($koneksi, "SELECT * FROM tb_training");
while ($plk = mysqli_fetch_array($query)) {
    $training_data[] = [
        'id_training' => $plk['id_training'],
        'id' => $plk['id'],
        'nama_pelaku' => $plk['nama_pelaku'],
        'sertifikat_spp' => $plk['sertifikat_spp'],
        'sertifikat_skp' => $plk['sertifikat_skp'],
        'sertifikat_halal' => $plk['sertifikat_halal'],
        'attg' => $plk['attg'],
        'pemasaran' => $plk['pemasaran'],
        'tanggal' => $plk['tanggal'],
        'kelayakan' => $plk['kelayakan'],
    ];
}

// Latih model Naive Bayes
list($model, $class_probs) = train_naive_bayes($training_data);

// Prediksi kelayakan untuk data testing
$query = mysqli_query($koneksi, "SELECT * FROM tb_testing");
while ($plk = mysqli_fetch_array($query)) {
    $test_record = [
        'id_testing' => $plk['id_testing'],
        'id_indikator' => $plk['id_indikator'],
        'nama_pelaku' => $plk['nama_pelaku'],
        'sertifikat_spp' => $plk['sertifikat_spp'],
        'sertifikat_skp' => $plk['sertifikat_skp'],
        'sertifikat_halal' => $plk['sertifikat_halal'],
        'attg' => $plk['attg'],
        'pemasaran' => $plk['pemasaran'],
    ];
    
    $predicted_kelayakan = predict_naive_bayes($model, $class_probs, $test_record);
    // Update data testing dengan kelayakan yang diprediksi
    $update_query = "UPDATE tb_testing SET kelayakan = '$predicted_kelayakan' WHERE id_testing = '{$plk['id_testing']}'";
    mysqli_query($koneksi, $update_query);
}
?>
