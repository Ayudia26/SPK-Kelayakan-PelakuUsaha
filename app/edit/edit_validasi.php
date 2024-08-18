<?php 
$id_validasi = $_GET['id_validasi'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_validasi WHERE id_validasi='$id_validasi'");
$view  = mysqli_fetch_array($query);
?>
<section class="content">
  <div class="container-fluid">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Validasi</h3>
      </div>
      <div class="card-body">
        <form method="post" action="update/update_validasi.php">
          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label>Id Validasi</label>
                <input type="text" class="form-control" placeholder="Id Validasi" name="id_validasi" value="<?php echo $view['id_validasi']; ?>" readonly>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Id verifikasi</label>
                <input type="text" class="form-control" placeholder="Id verifikasi" name="id_verifikasi" value="<?php echo $view['id_verifikasi']; ?>" >            
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tanggal Validasi</label>
                <input type="text" class="form-control" placeholder="Tanggal Validasi" name="tanggal_validasi" value="<?php echo $view['tanggal_validasi']; ?>">
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Status Validasi</label>
                <input type="text" class="form-control" placeholder="Status Validasi" name="status_validasi" value="<?php echo $view['status_validasi']; ?>">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" value="<?php echo $view['keterangan']; ?>">
              </div>
              
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-info">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</section>
