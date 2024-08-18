<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Verifikasi</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">Tambah Data</button>
            <br><br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Verifikasi</th>
                  <th>Id Pelaku</th>
                  <th>Nama Pelaku</th>
                  <th>Tanggal Verifikasi</th>
                  <th>Status Verifikasi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1020;
                $query = mysqli_query($koneksi,"SELECT * FROM tb_verifikasi");
                $nomor = 1; // Inisialisasi nomor baris
                while($plk = mysqli_fetch_array($query)){
                    $no++;
                ?>
                <tr>
                  <td><?php echo $nomor; ?></td> <!-- Kolom nomor baris -->
                  <td><?php echo $no; ?></td>
                  <td><?php echo $plk['id']; ?></td>
                  <td><?php echo $plk['nama_pelaku']; ?></td>
                  <td><?php echo $plk['tanggal_verifikasi']; ?></td>
                  <td id="status_verifikasi_<?php echo $plk['id_verifikasi']; ?>"><?php echo $plk['status_verifikasi']; ?></td>
                  <!-- Button untuk verifikasi -->
                  <td>
                    <button type="button" class="btn btn-success" onclick="verifikasi(<?php echo $plk['id_verifikasi']; ?>)">Verifikasi</button>
                    <button class="btn btn-sm btn-danger" onclick="hapus_verifikasi('<?php echo $plk['id_verifikasi'];?>', this)">Hapus</button>
                  </td>
                </tr>
                <?php
                  $nomor++; // Tingkatkan nomor baris setiap kali loop berjalan
                }?>
              </tbody>
              <!-- <tfoot>
                <tr>
                  <th>No</th>
                  <th>Id Verifikasi</th>
                  <th>Id Pelaku</th>
                  <th>Tanggal Verifikasi</th>
                  <th>Status Verifikasi</th>
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

<!-- Modal -->
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Verifikasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="add/tambah_verifikasi.php">
        <div class="modal-body">
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" placeholder="Id Verifikasi" name="id_verifikasi">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Id Pelaku Usaha" name="id">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Nama Pelaku Usaha" name="nama_pelaku">
            </div>
            <div class="col">
              <input type="date" class="form-control" placeholder="Tanggal Verifikasi" name="tanggal_verifikasi">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Status Verifikasi" name="status_verifikasi">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- JavaScript functions -->
<script>
function hapus_verifikasi(id_verifikasi, btn) {
    $.ajax({
        type: "POST",
        url: "delete/hapus_verifikasi.php", // Ensure this path is correct
        data: { id_verifikasi: id_verifikasi },
        success: function(response) {
            const res = JSON.parse(response);
            if (res.success) {
                $(btn).closest('tr').remove();
            } else {
                alert("Error: " + res.error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error details:", xhr, status, error);
            alert("Terjadi kesalahan saat menghapus verifikasi: " + error);
        }
    });
}
</script>



<?php
include('../../conf/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['tanggal_verifikasi'], $_POST['status_verifikasi'])) {
    $id = $_POST['id'];
    $tanggal_verifikasi = $_POST['tanggal_verifikasi'];
    $status_verifikasi = $_POST['status_verifikasi'];

    // Insert query without id_verifikasi
    $query = mysqli_query($koneksi, "INSERT INTO tb_verifikasi (id, tanggal_verifikasi, status_verifikasi) VALUES ('$id', '$tanggal_verifikasi', '$status_verifikasi')");

    if ($query) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add verification data', 'error' => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Incomplete data']);
}
?>

                
                <div class="col">
                <select class="form-control" name="nama_pelaku">
									<option selected>Pilih</option>
									<?php
									$det=mysqli_query($koneksi, "SELECT * FROM tb_indikator");
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['id_indikator'] ?>"><?php echo $d['nama_pelaku'] ?> <?php echo $d['sertifikat_spp'] ?> <?php echo $d['sertifikat_skp'] ?>, Uk. <?php echo $d['sertifikat_halal'] ?></option>
										<?php
								}
								?>
									</select>
								</div>

                <div class="col">
                <select class="form-control" name="nama_pelaku">
                    <option value="">Pilih Nama Pelaku Usaha</option>
                    <?php
                    $query_pelaku = mysqli_query($koneksi, "SELECT * FROM tb_pelaku");
                    while ($data_pelaku = mysqli_fetch_array($query_pelaku)) {
                        echo '<option value="' . $data_pelaku['nama_pelaku'] . '">' . $data_pelaku['nama_pelaku'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col">
                <select class="form-control" name="nama_pelaku">
									<option selected>Pilih</option>
									<?php
									$det=mysqli_query($koneksi, "SELECT * FROM tb_pelaku");
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['id'] ?>"><?php echo $d['nama_pelaku'] ?></option>
										<?php
								}
								?>
									</select>
								</div>

                <div class="col">
                <select class="form-control" name="id_indikator">
									<option selected>Pilih</option>
									<?php
									$det=mysqli_query($koneksi, "SELECT * FROM tb_indikator");
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['id_indikator'] ?>"><?php echo $d['id_indikator'] ?></option>
										<?php
								}
								?>
									</select>
								</div>


                <!-- Main content -->
<section class="content">
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
            <br></br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Training</th>
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
              <tbody>
                <?php 
                $no = 3000;
                $query = mysqli_query($koneksi,"SELECT * FROM tb_training");
                $nomor = 1; // Inisialisasi nomor baris
                while($plk = mysqli_fetch_array($query)){
                  $no++;
                ?>
                  <tr>
                    <td><?php echo $nomor; ?></td> <!-- Kolom nomor baris -->
                    <td><?php echo $no;?></td>
                    <td><?php echo $plk['id'];?></td>
                    <td><?php echo $plk['nama_pelaku'];?></td>
                    <td><?php echo $plk['sertifikat_spp'];?></td>
                    <td><?php echo $plk['sertifikat_skp'];?></td>
                    <td><?php echo $plk['sertifikat_halal'];?></td>
                    <td><?php echo $plk['attg'];?></td>
                    <td><?php echo $plk['pemasaran'];?></td>
                    <td><?php echo $plk['tanggal'];?></td>
                    <td><?php echo $plk['kelayakan'];?></td>
                    <td>
                      <button class="btn btn-sm btn-danger" onclick="hapus_training('<?php echo $plk['id_training']; ?>', this)">Hapus</button>
                      <a href="index.php?page=edit-training&&id_training=<?php echo $plk['id_training'];?>" class="btn btn-sm btn-success">Edit</a>
                    </td>
                  </tr>
                <?php 
                  $nomor++; // Tingkatkan nomor baris setiap kali loop berjalan
                }?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>o</th>
                  <th>o</th>
                  <th>o</th>
                  <th>o</th>
                  <th>o</th>
                  <th>o</th>
                  <th>o</th>
                  <th>o</th>
                  <th>o</th>
                  <th>o</th>
                </tr>
              </tfoot>
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
        <h4 class="modal-title">Tambah Data Training</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahDataForm" method="post" action="add/tambah_testing.php">
        <div class="modal-body">
          <div class="form-row">
          <div class="col">
              <input type="text" class="form-control" placeholder="Id Training" name="id_training" readonly>
            </div>
            <div class="col">
                <select class="form-control" name="id_indikator">
									<option selected>Pilih</option>
									<?php
									$det=mysqli_query($koneksi, "SELECT * FROM tb_indikator");
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['id_indikator'] ?>"><?php echo $d['id_indikator'] ?><?php echo $d['nama_pelaku'] ?></option>
										<?php
								}
								?>
									</select>
								</div>
            <div class="col">
                <select class="form-control" name="nama_pelaku">
									<option selected>Pilih</option>
									<?php
									$det=mysqli_query($koneksi, "SELECT * FROM tb_pelaku");
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['id'] ?>"><?php echo $d['nama_pelaku'] ?></option>
										<?php
								}
								?>
									</select>
								</div>
            
            <div class="col">
              <input type="text" class="form-control" placeholder="Sertifikat SPP-IRT" name="sertifikat_spp" required>
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Sertifikat SKP" name="sertifikat_skp" required>
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Sertifikat Halal" name="sertifikat_halal" required>
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="ATTG" name="attg" required>
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Jangkauan Pemasaran" name="pemasaran" required>
            </div>
            <div class="col">
              <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('tambahDataForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var form = this;

    fetch(form.action, {
        method: form.method,
        body: new FormData(form)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil disimpan.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.reload(); // Reload the page after confirmation
            });
        } else {
            Swal.fire({
                title: 'Gagal!',
                text: 'Data gagal disimpan: ' + (data.error || 'Kesalahan tidak diketahui.') + '\n' + (data.output || ''),
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat mengirim data: ' + error.message,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
});

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
              $(row).closest('tr').remove(); // Remove the row from the table
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
</script>