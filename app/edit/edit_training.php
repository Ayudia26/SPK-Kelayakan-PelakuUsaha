<?php 
$id_training = $_GET['id_training'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_training WHERE id_training='$id_training'");
$view  = mysqli_fetch_array($query);
?>
<section class="content">
  <div class="container-fluid">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Training</h3>
      </div>
      <div class="card-body">
        <form method="post" action="update/update_training.php">
          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label>Id Training</label>
                <input type="text" class="form-control" placeholder="Id Training" name="id_training" value="<?php echo $view['id_training']; ?>" readonly>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label>Id Pelaku</label>
                <input type="text" class="form-control" placeholder="Id Pelaku" name="id" value="<?php echo $view['id']; ?>" readonly>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Nama Pelaku Usaha</label>
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
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              
              <div class="form-group">
                <label>Sertifikat SPP-IRT</label>
                <input type="text" class="form-control" placeholder="Sertifikat SPP-IRT" name="sertifikat_spp" value="<?php echo $view['sertifikat_spp']; ?>">
              </div>
              <div class="form-group">
                <label>Sertifikat SKP</label>
                <input type="text" class="form-control" placeholder="Sertifikat SKP" name="sertifikat_skp" value="<?php echo $view['sertifikat_skp']; ?>">
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Sertifikat Halal</label>
                <input type="text" class="form-control" placeholder="Sertifikat Halal" name="sertifikat_halal" value="<?php echo $view['sertifikat_halal']; ?>">
              </div>
              <div class="form-group">
                <label>ATTG</label>
                <input type="text" class="form-control" placeholder="ATTG" name="attg" value="<?php echo $view['attg']; ?>">
              </div>
              <div class="form-group">
                <label>Jangkauan Pemasaran</label>
                <select class="custom-select" name="pemasaran">
                  <option value="<?php echo $view['pemasaran']; ?>" selected><?php echo $view['pemasaran']; ?></option>
                  <option value="Dalam Kota">Dalam Kota</option>
                  <option value="Luar Kota">Luar Kota</option>
                </select>
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" value="<?php echo $view['tanggal']; ?>">
              </div>
              <div class="form-group">
                <label>Kelayakan</label>
                <input type="text" class="form-control" placeholder="Kelayakan" name="kelayakan" value="<?php echo $view['kelayakan']; ?>">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-info">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</section>

