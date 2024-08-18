<?php 
$id_verifikasi = $_GET['id_verifikasi'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_verifikasi WHERE id_verifikasi='$id_verifikasi'");
$view  = mysqli_fetch_array($query);
?>
<section class="content">
  <div class="container-fluid">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Verifkasi</h3>
      </div>
      <div class="card-body">
        <form method="post" action="update/update_verifikasi.php">
          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label>Id Verifikasi</label>
                <input type="text" class="form-control" placeholder="Id Verifikasi" name="id_verifikasi" value="<?php echo $view['id_verifikasi']; ?>" readonly>
              </div>
            </div>
            <div class="col">
              <select class="form-control" name="id">
                <option selected>Pilih Pelaku</option>
                <?php
                $det = mysqli_query($koneksi, "SELECT * FROM tb_pelaku");
                while ($d = mysqli_fetch_array($det)) {
                  ?>
                  <option value="<?php echo $d['id'] ?>"><?php echo $d['nama_pelaku'] ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tanggal Verifikasi</label>
                <input type="date" class="form-control" placeholder="Tanggal Verifikasi" name="tanggal_verifikasi" value="<?php echo $view['tanggal_verifikasi']; ?>">
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Status Verifikasi</label>
                <input type="text" class="form-control" placeholder="Status Verifikasi" name="status_verifikasi" value="<?php echo $view['status_verifikasi']; ?>">
              </div>
             
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-info">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</section>
