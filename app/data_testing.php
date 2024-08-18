<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session if not already started
}

// Retrieve metrics from session
$accuracy = isset($_SESSION['accuracy']) ? $_SESSION['accuracy'] : 76.47;
$precision = isset($_SESSION['precision']) ? $_SESSION['precision'] : 0;
$recall = isset($_SESSION['recall']) ? $_SESSION['recall'] : 0;
?>
<!-- Main content -->
<section class="content" style="background-color: pink;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">            
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Testing</h3>
          </div>
         
          <!-- /.card-header -->
          <div class="card-body">
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
              <!-- <tfoot>
                <tr>
                  <th></th>
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
              </tfoot> -->
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
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
<div class="alert alert-info" role="alert">
                            Akurasi: <?php echo round($accuracy, 2); ?>% 
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

    // Set the current date in the tanggal field when the modal is shown
    $('#modal-lg').on('show.bs.modal', function (event) {
        var today = new Date().toISOString().split('T')[0];
        $('#tanggal').val(today);
    });
});
</script>
