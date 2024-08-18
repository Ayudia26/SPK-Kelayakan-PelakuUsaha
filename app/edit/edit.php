<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="app/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>LOGIN</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">--------------</p>

      <form action="conf/autentikasi.php" method="post">
        <div class="input-group mb-3">

<?php
include('../../conf/config.php');

// Memeriksa apakah semua parameter ada dalam URL
if (isset($_GET['id_indikator'], $_GET['nama_pelaku'], $_GET['sertifikat_spp'], $_GET['sertifikat_skp'], $_GET['sertifikat_halal'], $_GET['attg'], $_GET['pemasaran'])) {
    // Mengambil nilai variabel dari URL
    $id_indikator = $_POST['id_indikator'];
    $nama_pelaku = $_POST['nama_pelaku'];
    $sertifikat_spp = $_POST['sertifikat_spp'];
    $sertifikat_skp = $_POST['sertifikat_skp'];
    $sertifikat_halal = $_POST['sertifikat_halal'];
    $attg = $_POST['attg'];
    $pemasaran = $_POST['pemasaran'];

    // Melakukan query INSERT ke database
    $query = mysqli_query($koneksi, "INSERT INTO tb_indikator (id_indikator, nama_pelaku, sertifikat_spp, sertifikat_skp, sertifikat_halal, attg, pemasaran) VALUES('', '$nama_pelaku', '$sertifikat_spp', '$sertifikat_skp', '$sertifikat_halal', '$attg', '$pemasaran')");

    // Periksa apakah kueri berhasil atau tidak
    if ($query) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Ada parameter yang kurang dalam URL."]);
}
?>

<?php
include ('../../conf/config.php');

// Memeriksa apakah semua parameter ada dalam URL
if (isset($_GET['id_indikator'], $_GET['nama_pelaku'], $_GET['sertifikat_spp'], $_GET['sertifikat_skp'], $_GET['sertifikat_halal'], $_GET['attg'], $_GET['pemasaran'])) {
    // Mengambil nilai variabel dari URL
    $id_indikator = $_GET['id_indikator'];
    $nama_pelaku = $_GET['nama_pelaku'];
    $sertifikat_spp = $_GET['sertifikat_spp'];
    $sertifikat_skp = $_GET['sertifikat_skp'];
    $sertifikat_halal = $_GET['sertifikat_halal'];
    $attg = $_GET['attg'];
    $pemasaran = $_GET['pemasaran'];

    // Melakukan query INSERT ke database
    $query = mysqli_query($koneksi, "INSERT INTO tb_indikator (id_indikator, nama_pelaku, sertifikat_spp, sertifikat_skp, sertifikat_halal, attg, pemasaran) VALUES('$id_indikator', '$nama_pelaku', '$sertifikat_spp', '$sertifikat_skp', '$sertifikat_halal', '$attg', '$pemasaran')");

    // Periksa apakah kueri berhasil atau tidak
    if ($query) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Ada parameter yang kurang dalam URL."]);
}
?>

<?php
include('../../conf/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_validasi'])) {
    $id_validasi = $_POST['id_validasi'];

    // Melakukan query DELETE ke database
    $query = mysqli_query($koneksi, "DELETE FROM tb_validasi WHERE id_validasi = '$id_validasi'");

    // Periksa apakah kueri berhasil atau tidak
    if ($query) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID tidak ditemukan dalam permintaan."]);
}
?>

<?php
include('../../conf/config.php');

if (isset($_GET['id_verifikasi'])) {
    $id_verifikasi = $_GET['id_verifikasi'];

    // Melakukan query DELETE ke database
    $query = mysqli_query($koneksi, "DELETE FROM tb_verifikasi WHERE id_verifikasi = '$id_verifikasi'");

    // Periksa apakah kueri berhasil atau tidak
    if ($query) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID tidak ditemukan dalam URL."]);
}
?>

<?php
//display values in combobox/dropdown
$result = mysqli_query($koneksi,"SELECT * FROM tb_indikator");
  while($row = mysqli_fetch_assoc($result)){
     echo "<option value=$row[id_indikator]>$row[id_indikator] - $row[nama_pelaku]</option>";
    } 
?>

<div class="col">
              <select class="form-control" name="id_testing">
                <option selected>Pilih Pelaku</option>
                <?php
                $det = mysqli_query($koneksi, "SELECT * FROM tb_testing");
                while ($d = mysqli_fetch_array($det)) {
                  ?>
                  <option value="<?php echo $d['id_testing'] ?>"><?php echo $d['nama_pelaku'] ?><?php echo $d['kelayakan'] ?></option>
                  <?php
                }
                ?>
              </select>
            </div>

            <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="app/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>LOGIN</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">--------------</p>

      <form action="conf/autentikasi.php" method="post">
        <div class="input-group mb-3">
        <?php
                  // Assuming $koneksi is your database connection
                  $query_months = mysqli_query($koneksi, "SELECT FROM tb_testing");
                  
                ?>








<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Existing content here -->

    <!-- Accuracy, Precision, Recall -->
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Model Evaluation Metrics</h3>
          </div>
          <div class="card-body">
            <h5>Accuracy: <span id="accuracy"></span></h5>
            <h5>Precision: <span id="precision"></span></h5>
            <h5>Recall: <span id="recall"></span></h5>
          </div>
        </div>
      </div>
    </div>

    <!-- Select Month Filter and Table -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Testing</h3>
          </div>
          <div class="card-body">
            <!-- Your existing content with table and filters -->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
              Tambah Data
            </button>
            <br><br>
            <!-- Select Month Filter -->
            <div class="form-group">
              <label for="bulan">Filter by Month:</label>
              <select class="form-control" id="bulan" name="bulan">
                <option value="">-- Select Month --</option>
                <?php
                  // Assuming $koneksi is your database connection
                  $query_months = mysqli_query($koneksi, "SELECT DISTINCT MONTH(tanggal) AS month FROM tb_testing ORDER BY tanggal DESC");
                  while($month_data = mysqli_fetch_assoc($query_months)) {
                    $month_number = $month_data['month'];
                    $month_name = date("F", mktime(0, 0, 0, $month_number, 10)); // Get month name from month number
                    echo '<option value="' . $month_number . '">' . $month_name . '</option>';
                  }
                ?>
              </select>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Testing</th>
                  <th>Id Indikator</th>
                  <th>Nama Pelaku Usaha</th>
                  <th>Sertifikat SPP-IRT</th>
                  <th>Sertifikat SKP</th>
                  <th>Sertifikat Halal</th>
                  <th>ATTG</th>
                  <th>Jangkauan Pemasaran</th>
                  <th>Kelayakan</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="dataTabel">
                <?php 
                $no = 1; // Inisialisasi nomor baris
                $query = mysqli_query($koneksi, "SELECT * FROM tb_testing");
                while($plk = mysqli_fetch_array($query)){
                ?>
                <tr>
                  <td><?php echo $no; ?></td> <!-- Kolom nomor baris -->
                  <td><?php echo $plk['id_testing']; ?></td>
                  <td><?php echo $plk['id_indikator']; ?></td>
                  <td><?php echo isset($plk['nama_pelaku']) ? $plk['nama_pelaku'] : ''; ?></td>
                  <td><?php echo isset($plk['sertifikat_spp']) ? $plk['sertifikat_spp'] : ''; ?></td>
                  <td><?php echo isset($plk['sertifikat_skp']) ? $plk['sertifikat_skp'] : ''; ?></td>
                  <td><?php echo isset($plk['sertifikat_halal']) ? $plk['sertifikat_halal'] : ''; ?></td>
                  <td><?php echo isset($plk['attg']) ? $plk['attg'] : ''; ?></td>
                  <td><?php echo isset($plk['pemasaran']) ? $plk['pemasaran'] : ''; ?></td>
                  <td><?php echo isset($plk['kelayakan']) ? $plk['kelayakan'] : ''; ?></td>
                  <td><?php echo isset($plk['tanggal']) ? $plk['tanggal'] : ''; ?></td>
                  <td>
                    <button class="btn btn-sm btn-danger" onclick="hapus_testing('<?php echo $plk['id_testing']; ?>', this)">Hapus</button>
                    <a href="index.php?page=edit-testing&&id_testing=<?php echo $plk['id_testing']; ?>" class="btn btn-sm btn-success">Edit</a>
                  </td>
                </tr>
                <?php 
                  $no++;
                }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Testing</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahDataForm" method="post" action="add/tambah_testing.php">
        <div class="modal-body">
          <div class="form-group">
            <label for="id_testing">Id Testing</label>
            <input type="text" class="form-control" id="id_testing" name="id_testing" readonly>
          </div>
          <div class="form-group">
            <label for="id_indikator">Id Indikator</label>
            <input type="text" class="form-control" id="id_indikator" name="id_indikator" required>
          </div>
          <div class="form-group">
            <label for="nama_pelaku">Nama Pelaku Usaha</label>
            <select class="form-control" id="nama_pelaku" name="nama_pelaku">
              <option selected>Pilih</option>
              <?php
              $det=mysqli_query($koneksi, "SELECT * FROM tb_indikator");
              while($d=mysqli_fetch_array($det)){
              ?>
              <option value="<?php echo $d['nama_pelaku'] ?>"><?php echo $d['nama_pelaku'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="sertifikat_spp">Sertifikat SPP-IRT</label>
            <input type="text" class="form-control" id="sertifikat_spp" name="sertifikat_spp" required>
          </div>
          <div class="form-group">
            <label for="sertifikat_skp">Sertifikat SKP</label>
            <input type="text" class="form-control" id="sertifikat_skp" name="sertifikat_skp" required>
          </div>
          <div class="form-group">
            <label for="sertifikat_halal">Sertifikat Halal</label>
            <input type="text" class="form-control" id="sertifikat_halal" name="sertifikat_halal" required>
          </div>
          <div class="form-group">
            <label for="attg">ATTG</label>
            <input type="text" class="form-control" id="attg" name="attg" required>
          </div>
          <div class="form-group">
            <label for="pemasaran">Jangkauan Pemasaran</label>
            <input type="text" class="form-control" id="pemasaran" name="pemasaran" required>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  
$(document).ready(function() {
    function hapus_testing(id_testing, row) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("delete/hapus_testing.php", { id_testing: id_testing }, function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil dihapus.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $(row).closest('tr').remove();
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data gagal dihapus: ' + (data.error || 'Kesalahan tidak diketahui.'),
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }, "json").fail(function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menghapus data: ' + errorThrown,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });
    }

    window.hapus_testing = hapus_testing; // Pastikan fungsi tersedia secara global

    // Handle month filter
    $('#bulan').change(function() {
      var selectedMonth = $(this).val();
      $.ajax({
        url: 'filter_data.php',
        type: 'POST',
        data: { bulan: selectedMonth },
        success: function(response) {
          $('#dataTabel').html(response); // Update the table body with filtered data
        }
      });
    });

   // Fetch metrics from calculate_metrics.php
$(document).ready(function() {
  $.ajax({
    url: 'calculate_metrics.php',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      if (response && response.success) {
        $('#accuracy').text(response.accuracy.toFixed(2) + '%');
        $('#precision').text(response.precision.toFixed(2) + '%');
        $('#recall').text(response.recall.toFixed(2) + '%');
      } else {
        console.error('Failed to fetch metrics:', response.error);
      }
    },
    error: function(xhr, status, error) {
      console.error('Error fetching metrics:', error);
    }
  });
});



    // Set the current date in the tanggal field when the modal is shown
    $('#modal-lg').on('show.bs.modal', function (event) {
        var today = new Date().toISOString().split('T')[0];
        $('#tanggal').val(today);
    });
});
</script>
