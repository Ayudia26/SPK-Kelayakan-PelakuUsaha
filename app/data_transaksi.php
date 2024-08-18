<!-- Main content -->
<section class="content" style="background-color: pink;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Transaksi</h3>
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
                  <th>Id Transaksi</th>
                  <th>Id Pelaku</th>
                  <th>Nama Pelaku Usaha</th>
                  <th>Nama Produk</th>
                  <th>Volume Produk/thn (Kg)</th>
                  <th>Omset/thn (Rp)</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1000;
                $query = mysqli_query($koneksi,"SELECT * FROM tb_transaksi");
                $nomor = 1; // Inisialisasi nomor baris
                while($plk = mysqli_fetch_array($query)){
                    $no++;
                ?>
                <tr>
                  <td><?php echo $nomor; ?></td> <!-- Kolom nomor baris -->
                  <td><?php echo $no;?></td>
                  <td><?php echo $plk['id'];?></td>
                  <td><?php echo $plk['nama_pelaku'];?></td>
                  <td><?php echo $plk['nama_produk'];?></td>
                  <td><?php echo $plk['volume_produk'];?></td>
                  <td><?php echo $plk['omset'];?></td>
                  <td><?php echo $plk['tanggal'];?></td>
                  <td>
                    <button class="btn btn-sm btn-danger" onclick="hapus_data('<?php echo $plk['id_transaksi'];?>')">Hapus</button>
                    <a href="index.php?page=edit-transaksi&&id_transaksi=<?php echo $plk['id_transaksi'];?>" class="btn btn-sm btn-success">Edit</a>
                </td>
                </tr>
                <?php 
                  $nomor++; // Tingkatkan nomor baris setiap kali loop berjalan
                }?>
              </tbody>
              <!-- <tfoot>
                <tr>
                  <th>No</th>
                  <th>Id Transaksi</th>
                  <th>Id Pelaku</th>
                  <th>Nama Pelaku Usaha</th>
                  <th>Nama Produk</th>
                  <th>Volume Produk</th>
                  <th>Omset</th>
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
        <h4 class="modal-title">Tambah Transaksi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahDataForm" method="post" action="add/tambah_transaksi.php">
        <div class="modal-body">
          <div class="form-group">
            <label for="id_transaksi">Id Transaksi</label>
            <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" placeholder="Id Transaksi" readonly>
          </div>
          <div class="form-group">
            <label for="id">Pilih Id Pelaku</label>
            <select class="form-control" id="id" name="id">
              <option selected>Pilih</option>
              <?php
              $det=mysqli_query($koneksi, "SELECT * FROM tb_pelaku");
              while($d=mysqli_fetch_array($det)){
              ?>
                <option value="<?php echo $d['id'] ?>"><?php echo $d['id'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama_pelaku">Pilih Nama Pelaku</label>
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
            <label for="nama_produk">Pilih Nama Produk</label>
            <select class="form-control" id="nama_produk" name="nama_produk">
              <option selected>Pilih</option>
              <?php
              $det=mysqli_query($koneksi, "SELECT * FROM tb_pelaku");
              while($d=mysqli_fetch_array($det)){
              ?>
                <option value="<?php echo $d['nama_produk'] ?>"><?php echo $d['nama_produk'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="volume_produk">Volume Produk</label>
            <input type="text" class="form-control" id="volume_produk" name="volume_produk" placeholder="Volume Produk" required>
          </div>
          <div class="form-group">
            <label for="omset">Omset</label>
            <input type="text" class="form-control" id="omset" name="omset" placeholder="Omset" required>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal" required>
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
        fetch('delete/hapus_transaksi.php?id_transaksi=' + data_id, {
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
