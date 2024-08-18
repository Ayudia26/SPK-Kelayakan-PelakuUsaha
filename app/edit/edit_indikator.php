<?php 
$id_indikator = $_GET['id_indikator'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_indikator WHERE id_indikator='$id_indikator'");
$view  = mysqli_fetch_array($query);
?>
<section class="content">
  <div class="container-fluid">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Indikator</h3>
      </div>
      <div class="card-body">
        <form method="post" action="update/update_indikator.php">
          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label>Id Indikator</label>
                <input type="text" class="form-control" placeholder="Id Indikator" name="id_indikator" value="<?php echo $view['id_indikator']; ?>" readonly>
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
                <select class="custom-select" name="sertifikat_spp">
                  <option value="<?php echo $view['sertifikat_spp']; ?>" selected><?php echo $view['sertifikat_spp']; ?></option>
                  <option value="Ada">Ada</option>
                  <option value="Tidak Ada">Tidak Ada</option>
                </select>
              </div>
              <div class="form-group">
                <label>Sertifikat SKP</label>
                <select class="custom-select" name="sertifikat_skp">
                  <option value="<?php echo $view['sertifikat_skp']; ?>" selected><?php echo $view['sertifikat_skp']; ?></option>
                  <option value="Ada">Ada</option>
                  <option value="Tidak Ada">Tidak Ada</option>
                </select>
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-sm-6">
            <div class="form-group">
                <label>Sertifikat Halal</label>
                <select class="custom-select" name="sertifikat_halal">
                  <option value="<?php echo $view['sertifikat_halal']; ?>" selected><?php echo $view['sertifikat_halal']; ?></option>
                  <option value="Ada">Ada</option>
                  <option value="Tidak Ada">Tidak Ada</option>
                </select>
              </div>
              <div class="form-group">
                <label>ATTG</label>
                <select class="custom-select" name="attg">
                  <option value="<?php echo $view['attg']; ?>" selected><?php echo $view['attg']; ?></option>
                  <option value="Ada">Ada</option>
                  <option value="Tidak Ada">Tidak Ada</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jangkauan Pemasaran</label>
                <select class="custom-select" name="pemasaran">
                  <option value="<?php echo $view['pemasaran']; ?>" selected><?php echo $view['pemasaran']; ?></option>
                  <option value="Dalam Kota">Dalam Kota</option>
                  <option value="Luar Kota">Luar Kota</option>
                </select>              
              </div> 
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-info">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</section>
