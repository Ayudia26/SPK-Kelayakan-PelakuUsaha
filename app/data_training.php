<!-- Main content -->
<section class="content" style="background-color: pink;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">            
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Training</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
              Tambah Data
            </button>
            <br><br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Training</th>
                  <th>Id Pelaku</th>
                  <th>Nama Pelaku Usaha</th>
                  <th>Sertifikat SPP-IRT</th>
                  <th>Sertifikat SKP</th>
                  <th>Sertifikat Halal</th>
                  <th>ATTG</th>
                  <th>Jangkauan Pemasaran</th>
                  <th>Tanggal</th>
                  <th>Kelayakan</th>
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
      <form id="tambahDataForm" method="post" action="add/tambah_training.php">
        <div class="modal-body">
          <div class="form-group">
            <label for="id_training">Id Training</label>
            <input type="text" class="form-control" id="id_training" placeholder="Id Training" name="id_training" readonly>
          </div>
          <div class="form-group">
            <label for="id">Pilih Pelaku Usaha</label>
            <select class="form-control" id="id" name="id">
              <option selected>Pilih Pelaku Usaha</option>
              <?php
              $det = mysqli_query($koneksi, "SELECT * FROM tb_pelaku");
              while($d = mysqli_fetch_array($det)){
              ?>
                <option value="<?php echo $d['id'] ?>"><?php echo $d['nama_pelaku'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="sertifikat_spp">Sertifikat SPP-IRT</label>
            <input type="text" class="form-control" id="sertifikat_spp" placeholder="Sertifikat SPP-IRT" name="sertifikat_spp">
          </div>
          <div class="form-group">
            <label for="sertifikat_skp">Sertifikat SKP</label>
            <input type="text" class="form-control" id="sertifikat_skp" placeholder="Sertifikat SKP" name="sertifikat_skp">
          </div>
          <div class="form-group">
            <label for="sertifikat_halal">Sertifikat Halal</label>
            <input type="text" class="form-control" id="sertifikat_halal" placeholder="Sertifikat Halal" name="sertifikat_halal">
          </div>
          <div class="form-group">
            <label for="attg">ATTG</label>
            <input type="text" class="form-control" id="attg" placeholder="ATTG" name="attg">
          </div>
          <div class="form-group">
            <label for="pemasaran">Jangkauan Pemasaran</label>
            <input type="text" class="form-control" id="pemasaran" placeholder="Jangkauan Pemasaran" name="pemasaran">
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" placeholder="Tanggal" name="tanggal">
          </div>
          <div class="form-group">
            <label for="kelayakan">Kelayakan</label>
            <input type="text" class="form-control" id="kelayakan" placeholder="Kelayakan" name="kelayakan">
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
          window.location.reload(); // Muat ulang halaman setelah konfirmasi
        });
      } else {
        Swal.fire({
          title: 'Gagal!',
          text: 'Data gagal disimpan: ' + (data.error || 'Kesalahan tidak diketahui.'),
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

  function hapus_training(id_training, row) {
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
        $.post("delete/hapus_training.php", { id_training: id_training }, function(data) {
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
