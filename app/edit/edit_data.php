<?php 
$id    = $_GET['id'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_pelaku WHERE id='$id'");
$view  = mysqli_fetch_array($query);
?>
<section class="content">
  <div class="container-fluid">
        <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit Data Pelaku Usaha</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method='get' action='update/update_data.php'>
                  <div class="row">
                    <div class="col-sm-2">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Id Pelaku Usaha</label>
                        <input type="text" class="form-control" placeholder="Id Pelaku Usaha" name="id" value="<?php echo $view['id'];?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nama Pelaku Usaha</label>
                        <input type="text" class="form-control" placeholder="Nama Pelaku Usaha" name="nama_pelaku" value="<?php echo $view['nama_pelaku'];?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Kecamatan</label>
                       <!-- <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea> -->
                        <input type="text" class="form-control" rows="3" placeholder="Kecamatan" name="kecamatan" value="<?php echo $view['kecamatan'];?>">
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                       <!-- <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea> -->
                       <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="<?php echo $view['alamat'];?>">
                      </div>
                    </div> 
                  </div>
             <div class="row">
                <div class="col-sm-6">
                  <!-- input states -->
                  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Nama Produk</label>
                    <input type="text" class="form-control" placeholder="Nama Produk" name="nama_produk" value="<?php echo $view['nama_produk'];?>">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="inputWarning">No KUSUKA</label>
                      <input type="text" class="form-control" placeholder="No KUSUKA" name="no_kusuka" value="<?php echo $view['no_kusuka'];?>">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="inputError">Status</label>
                      <select class="custom-select" id="inputGroupSelect01" name="status">
                        <option value="<?php echo $view['status'];?>" selected><?php echo $view['status'];?></option>
                        <option value="Aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                      </select>
                  </div>
                  <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label" for="inputWarning">Tanggal</label>
                    <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" value="<?php echo $view['tanggal'];?>">
                  </div>
                  </div>
</div>
</div>
                  <button type="submit" class="btn btn-sm btn-info">Simpan</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
</div>
</section>

