<section class="content" style="background-color: pink;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">            
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Penilaian</h3>
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
              Tambah Data
            </button>
            <br><br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Penilaian</th>
                  <th>Indikator</th>
                  <th>Keterangan</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 8000;
                $query = mysqli_query($koneksi, "SELECT * FROM tb_penilaian");
                $nomor = 1;
                while($plk = mysqli_fetch_array($query)){
                    $no++;
                ?>
                <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $plk['indikator']; ?></td>
                  <td><?php echo $plk['keterangan']; ?></td>
                  <td><?php echo $plk['nilai']; ?></td>
                  <td>
                    <button class="btn btn-sm btn-danger" onclick="hapus_training('<?php echo $plk['id_penilaian']; ?>', this)">Hapus</button>
                    <a href="index.php?page=edit-penilaian&&id_penilaian=<?php echo $plk['id_penilaian'];?>" class="btn btn-sm btn-success">Edit</a>
                  </td>
                </tr>
                <?php 
                  $nomor++;
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Id Penilaian</th>
                  <th>Indikator</th>
                  <th>Keterangan</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Penilaian</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="add/tambah_penilaian.php">
        <div class="modal-body">
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" placeholder="Id Penilaian" name="id_penilaian" readonly>
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Indikator" name="indikator" required>
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" required>
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Nilai" name="nilai" required>
            </div>
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

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function hapus_training(id_penilaian, row) {
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
        $.post("delete/hapus_penilaian.php", { id_penilaian: id_penilaian }, function(data) {
          if (data.success) {
            Swal.fire({
              title: 'Berhasil!',
              text: 'Data berhasil dihapus.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              $(row).closest('tr').remove(); // Remove the row from the table
            });
          } else {
            Swal.fire({
              title: 'Gagal!',
              text: 'Data gagal dihapus: ' + (data.error || 'Kesalahan tidak diketahui.'),
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        }, "json").fail(function(jqXHR, textStatus, errorThrown) {
          Swal.fire({
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat menghapus data: ' + errorThrown,
            icon: 'error',
            confirmButtonText: 'OK'
          });
        });
      }
    });
  }
</script>
