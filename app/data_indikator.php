<!-- Main content -->
<section class="content" style="background-color: pink;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Indikator</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
              Tambah Indikator
            </button>
            <br></br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Indikator</th>
                  <th>Nama Pelaku Usaha</th>
                  <th>Sertifikat SPP-IRT</th>
                  <th>Sertifikat SKP</th>
                  <th>Sertifikat Halal</th>
                  <th>ATTG</th>
                  <th>Jangkauan Pemasaran</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 500;
                $query = mysqli_query($koneksi,"SELECT * FROM tb_indikator");
                $nomor = 1; // Inisialisasi nomor baris
                while($plk = mysqli_fetch_array($query)){
                    $no++;
                ?>
                <tr>
                  <td><?php echo $nomor; ?></td> <!-- Kolom nomor baris -->
                  <td><?php echo $no;?></td>
                  <td><?php echo $plk['nama_pelaku'];?></td>
                  <td><?php echo $plk['sertifikat_spp'];?></td>
                  <td><?php echo $plk['sertifikat_skp'];?></td>
                  <td><?php echo $plk['sertifikat_halal'];?></td>
                  <td><?php echo $plk['attg'];?></td>
                  <td><?php echo $plk['pemasaran'];?></td>
                  <td>
                    <button class="btn btn-sm btn-danger" onclick="hapus_data('<?php echo $plk['id_indikator'];?>')">Hapus</button>
                    <a href="index.php?page=edit-indikator&&id_indikator=<?php echo $plk['id_indikator'];?>" class="btn btn-sm btn-success">Edit</a>
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

<!-- Modal untuk tambah indikator -->
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Indikator</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahDataForm" method="post" action="add/tambah_indikator.php" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="id_indikator">Id Indikator</label>
            <input type="text" class="form-control" id="id_indikator" placeholder="Id Indikator" name="id_indikator" disabled>
          </div>
          <div class="form-group">
            <label for="nama_pelaku">Nama Pelaku Usaha</label>
            <select class="form-control" id="nama_pelaku" name="nama_pelaku">
              <option selected>Pilih</option>
              <?php
              $det=mysqli_query($koneksi, "SELECT * FROM tb_pelaku");
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
            <select class="form-control" id="sertifikat_spp" name="sertifikat_spp">
              <option selected>Sertifikat SPP-IRT</option>
              <option value="Ada">Ada</option>
              <option value="Tidak Ada">Tidak Ada</option>
            </select>
          </div>
          <div class="form-group">
            <label for="sertifikat_skp">Sertifikat SKP</label>
            <select class="form-control" id="sertifikat_skp" name="sertifikat_skp">
              <option selected>Sertifikat SKP</option>
              <option value="Ada">Ada</option>
              <option value="Tidak Ada">Tidak Ada</option>
            </select>
          </div>
          <div class="form-group">
            <label for="sertifikat_halal">Sertifikat Halal</label>
            <select class="form-control" id="sertifikat_halal" name="sertifikat_halal">
              <option selected>Sertifikat Halal</option>
              <option value="Ada">Ada</option>
              <option value="Tidak Ada">Tidak Ada</option>
            </select>
          </div>
          <div class="form-group">
            <label for="attg">ATTG</label>
            <select class="form-control" id="attg" name="attg">
              <option selected>ATTG</option>
              <option value="Ada">Ada</option>
              <option value="Tidak Ada">Tidak Ada</option>
            </select>
          </div>
          <div class="form-group">
            <label for="pemasaran">Jangkauan Pemasaran</label>
            <select class="form-control" id="pemasaran" name="pemasaran">
              <option selected>Pemasaran</option>
              <option value="Dalam Kota">Dalam Kota</option>
              <option value="Luar Kota">Luar Kota</option>
            </select>
          </div>
          <div class="form-group">
            <label for="file_upload">Unggah File</label>
            <input type="file" class="form-control-file" id="file_upload" name="file_upload">
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

  function hapus_data(data_id) {
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
        fetch('delete/hapus_indikator.php?id_indikator=' + data_id, {
          method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              title: 'Berhasil!',
              text: 'Data berhasil dihapus.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.reload(); // Muat ulang halaman setelah konfirmasi
            });
          } else {
            Swal.fire({
              title: 'Gagal!',
              text: 'Data gagal dihapus: ' + (data.error || 'Kesalahan tidak diketahui.'),
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        })
        .catch(error => {
          Swal.fire({
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat menghapus data: ' + error.message,
            icon: 'error',
            confirmButtonText: 'OK'
          });
        });
      }
    });
  }
</script>
