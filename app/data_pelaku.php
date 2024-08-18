<!-- Konten Utama -->
<section class="content" style="background-color: pink;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">            
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Pelaku Usaha</h3>
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
                  <th>Id Pelaku</th>
                  <th>Nama Pelaku Usaha</th>
                  <th>Kecamatan</th>
                  <th>Alamat</th>
                  <th>Nama Produk</th>
                  <th>No KUSUKA</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 2023;
                $query = mysqli_query($koneksi,"SELECT * FROM tb_pelaku");
                $nomor = 1; // Inisialisasi nomor baris
                while($plk = mysqli_fetch_array($query)){
                    $no++
                ?>
                <tr>
                  <td><?php echo $nomor; ?></td> <!-- Kolom nomor baris -->
                  <td><?php echo $no;?></td>
                  <td><?php echo $plk['nama_pelaku'];?></td>
                  <td><?php echo $plk['kecamatan'];?></td>
                  <td><?php echo $plk['alamat'];?></td>
                  <td><?php echo $plk['nama_produk'];?></td>
                  <td><?php echo $plk['no_kusuka'];?></td>
                  <td><?php echo $plk['status'];?></td>
                  <td><?php echo $plk['tanggal'];?></td>
                  <td>
                    <a onclick="hapus_data(<?php echo $plk['id'];?>)" class="btn btn-sm btn-danger">Hapus</a>
                    <a href="index.php?page=edit-data&& id=<?php echo $plk['id'];?>" class="btn btn-sm btn-success">Edit</a>
                  </td>
                </tr>
                <?php 
                  $nomor++; // Tingkatkan nomor baris setiap kali loop berjalan
                }?>
              </tbody>
              <tfoot>
                <tr>
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
        <h4 class="modal-title">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahDataForm" method="get" action="add/tambah_data.php">
        <div class="modal-body">
          <div class="form-group">
            <label for="id">Id Pelaku Usaha</label>
            <input type="text" class="form-control" id="id" name="id" readonly>
          </div>
          <div class="form-group">
            <label for="nama_pelaku">Nama Pelaku Usaha</label>
            <input type="text" class="form-control" id="nama_pelaku" name="nama_pelaku">
          </div>
          <div class="form-group">
            <label for="kecamatan">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
          </div>
          <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk">
          </div>
          <div class="form-group">
            <label for="no_kusuka">No KUSUKA</label>
            <input type="text" class="form-control" id="no_kusuka" name="no_kusuka">
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select class="custom-select" id="status" name="status">
              <option selected>Pilih</option>
              <option value="Aktif">Aktif</option>
              <option value="Tidak aktif">Tidak Aktif</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('tambahDataForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var form = this;

    fetch(form.action + '?' + new URLSearchParams(new FormData(form)), {
      method: 'GET'
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
        fetch('delete/hapus_data.php?id=' + data_id, {
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
