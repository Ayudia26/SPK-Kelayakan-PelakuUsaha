<?php 
$id_penilaian = $_GET['id_penilaian'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_penilaian WHERE id_penilaian='$id_penilaian'");
$view  = mysqli_fetch_array($query);
?>
<section class="content">
  <div class="container-fluid">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Penilaian</h3>
      </div>
      <div class="card-body">
        <form method="post" action="update/update_indikator.php">
          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label>Id Penilaian</label>
                <input type="text" class="form-control" placeholder="Id Penilaian" name="id_penilaian" value="<?php echo $view['id_penilaian']; ?>" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Indikator</label>
                <input type="text" class="form-control" placeholder="Indikator" name="indikator" value="<?php echo $view['indikator']; ?>">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" value="<?php echo $view['keterangan']; ?>">
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nilai</label>
                <input type="text" class="form-control" placeholder="Nilai" name="nilai" value="<?php echo $view['nilai']; ?>">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-info">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</section>
