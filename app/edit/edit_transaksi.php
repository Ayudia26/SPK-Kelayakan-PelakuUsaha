<?php
$id_transaksi = $_GET['id_transaksi'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE id_transaksi='$id_transaksi'");
$view = mysqli_fetch_array($query);
?>
<section class="content">
  <div class="container-fluid">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Data Transaksi</h3>
      </div>
      <div class="card-body">
        <form id="editForm" method="post" action="update/update_transaksi.php">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Id Transaksi</label>
                <input type="text" class="form-control" placeholder="Id Transaksi" name="id_transaksi" value="<?php echo $view['id_transaksi']; ?>" readonly>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Id Pelaku Usaha</label>
                <input type="text" class="form-control" placeholder="Id Pelaku Usaha" name="id" value="<?php echo $view['id']; ?>" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Pelaku Usaha</label>
                <input type="text" class="form-control" placeholder="Nama Pelaku" name="nama_pelaku" value="<?php echo $view['nama_pelaku']; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" class="form-control" placeholder="Nama Produk" name="nama_produk" value="<?php echo $view['nama_produk']; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Volume Produk</label>
                <input type="text" class="form-control" placeholder="Volume Produk" name="volume_produk" value="<?php echo $view['volume_produk']; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Omset</label>
                <input type="text" class="form-control" placeholder="Omset" name="omset" value="<?php echo $view['omset']; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" value="<?php echo $view['tanggal']; ?>">
              </div>
            </div>
          </div>
          <button type="button" id="editButton" class="btn btn-sm btn-info">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('editButton').addEventListener('click', function() {
    // Menggunakan SweetAlert2 untuk konfirmasi
    Swal.fire({
      title: 'Apakah Anda yakin ingin menyimpan perubahan?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, Simpan',
      cancelButtonText: 'Batal'
    }).then((result) => {
      // Jika pengguna mengonfirmasi, kirim formulir
      if (result.isConfirmed) {
        var form = document.getElementById('editForm');
        fetch(form.action, {
          method: form.method,
          body: new FormData(form)
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Terjadi kesalahan.');
          }
          // Tampilkan pesan SweetAlert2 tanpa menunggu respons dari server
          Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil disimpan.',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(() => {
            window.location.reload(); // Muat ulang halaman setelah konfirmasi
          });
        })
        .catch(error => {
          Swal.fire({
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat menyimpan data: ' + error.message,
            icon: 'error',
            confirmButtonText: 'OK'
          });
        });
      }
    });
  });
</script>
