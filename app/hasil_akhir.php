<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Hasil</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
              Tambah Hasil
            </button>
            <br></br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Hasil</th>
                  <th>Id Testing</th>
                  <th>Nama Pelaku Usaha</th>
                  <th>Kelayakan</th>
                  <th>Hasil</th>
                  <!-- <th>Aksi</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1300;
                $query = mysqli_query($koneksi,"SELECT * FROM tb_hasil");
                $nomor = 1; // Inisialisasi nomor baris
                while($plk = mysqli_fetch_array($query)){
                    $no++;
                ?>
                <tr>
                  <td><?php echo $nomor; ?></td> <!-- Kolom nomor baris -->
                  <td><?php echo $no;?></td>
                  <td><?php echo $plk['id_testing'];?></td>
                  <td><?php echo $plk['nama_pelaku'];?></td>
                  <td><?php echo $plk['kelayakan'];?></td>
                  <td><?php echo $plk['hasil'];?></td>
                  <!-- <td>
                    <button class="btn btn-sm btn-danger" onclick="hapus_hasil('<?php echo $plk['id_hasil'];?>')">Hapus</button>
                  </td> -->
                </tr>
                <?php 
                  $nomor++; // Tingkatkan nomor baris setiap kali loop berjalan
                }?>
              </tbody>
              <!-- <tfoot>
                <tr>
                  <th>No</th>
                  <th>Id Indikator</th>
                  <th>Nama Pelaku Usaha</th>
                  <th>Sertifikat SPP-IRT</th>
                  <th>Sertifikat SKP</th>
                  <th>Sertifikat Halal</th>
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
        <h4 class="modal-title">Tambah Hasil</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahDataForm" method="post" action="add/tambah_hasil.php">
        <div class="modal-body">
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" placeholder="Id Hasil" name="id_hasil" disabled>
            </div>
            <div class="col">
        <select class="form-control" name="id_testing" required>
          <option selected>Pilih Pelaku</option>
          <?php
          $det = mysqli_query($koneksi, "SELECT * FROM tb_testing");
          while ($d = mysqli_fetch_array($det)) {
            echo "<option value='" . $d['id_testing'] . "'>" . $d['nama_pelaku'] . "</option>";
          }
          ?>
        </select>
      </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Kelayakan" name="kelayakan" id="kelayakan">
            </div>
            <!-- <div class="col">
              <input type="text" class="form-control" placeholder="Hasil" name="hasil" id="hasil" readonly>
            </div> -->
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
document.getElementById('kelayakan').addEventListener('input', function() {
    var kelayakanValue = this.value;
    var hasilInput = document.getElementById('hasil');
    
    if (kelayakanValue.toLowerCase() === 'layak') {
        hasilInput.value = 'Siap dipromosikan';
    } else if (kelayakanValue.toLowerCase() === 'tidak layak') {
        hasilInput.value = 'Perlu dibina kembali';
    } else {
        hasilInput.value = ''; // Clear the hasil input if kelayakan value is not recognized
    }
});

document.getElementById('tambahDataForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
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
                window.location.reload(); // Reload the page after confirmation
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
            fetch('delete/hapus_indikator.php?id_indikator=' + data_id, {
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
                        window.location.reload(); // Reload the page after confirmation
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
