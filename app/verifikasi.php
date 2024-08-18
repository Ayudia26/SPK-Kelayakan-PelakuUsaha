<!-- Main content -->
<section class="content" style="background-color: pink;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Verifikasi</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">Tambah Data</button>
            <br><br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Verifikasi</th>
                  <th>Id Pelaku</th>
                  <th>Nama Pelaku</th>
                  <th>Tanggal Verifikasi</th>
                  <th>Status Verifikasi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1020;
                $query = mysqli_query($koneksi,"SELECT * FROM tb_verifikasi");
                $nomor = 1; // Inisialisasi nomor baris
                while($plk = mysqli_fetch_array($query)){
                    $no++;
                ?>
                <tr>
                  <td><?php echo $nomor; ?></td> <!-- Kolom nomor baris -->
                  <td><?php echo $no; ?></td>
                  <td><?php echo $plk['id']; ?></td>
                  <td><?php echo $plk['nama_pelaku'] ?? ''; ?></td> <!-- Fixing undefined array key -->
                  <td><?php echo $plk['tanggal_verifikasi']; ?></td>
                  <td id="status_verifikasi_<?php echo $plk['id_verifikasi']; ?>"><?php echo $plk['status_verifikasi']; ?></td>
                  <!-- Button untuk verifikasi -->
                  <td>
                    <button type="button" class="btn btn-primary" onclick="verifikasi(<?php echo $plk['id_verifikasi']; ?>)">Verifikasi</button>
                    <button class="btn btn-sm btn-danger" onclick="hapus_verifikasi('<?php echo $plk['id_verifikasi'];?>', this)">Hapus</button>
                    <a href="index.php?page=edit-verifikasi&&id_verifikasi=<?php echo $plk['id_verifikasi'];?>" class="btn btn-sm btn-success">Edit</a>
                  </td>
                </tr>
                <?php
                  $nomor++; // Tingkatkan nomor baris setiap kali loop berjalan
                }?>
              </tbody>
              <!-- <tfoot>
                <tr>
                  <th>No</th>
                  <th>Id Verifikasi</th>
                  <th>Id Pelaku</th>
                  <th>Tanggal Verifikasi</th>
                  <th>Status Verifikasi</th>
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

<!-- Modal -->
<div class="modal fade" id="modal-lg" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Verifikasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="add/tambah_verifikasi.php">
        <div class="modal-body">
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" placeholder="Id Verifikasi" name="id_verifikasi" readonly>
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
            <div class="col">
              <input type="date" class="form-control" placeholder="Tanggal Verifikasi" name="tanggal_verifikasi">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Status Verifikasi" name="status_verifikasi">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<!-- JavaScript functions -->
<script>
  $(document).ready(function() {
  $('#formTambahVerifikasi').submit(function(e) {
    e.preventDefault(); // Prevent form submission

    // Submit form via AJAX
    $.ajax({
      type: 'POST',
      url: 'add/tambah_verifikasi.php', // Adjust URL as per your project structure
      data: $(this).serialize(),
      dataType: 'json', // Expect JSON response from the server
      success: function(response) {
        // Check success status
        if (response.success) {
          // Show success message using SweetAlert2
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Data berhasil ditambahkan.'
          }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
              $('#modal-lg').modal('hide'); // Hide modal on confirmation
              // Optionally, refresh or update the table
            }
          });
        } else {
          // Show error message using SweetAlert2
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: response.message
          });
        }
      },
      error: function(xhr, status, error) {
        console.error('Error:', xhr, status, error);
        // Show generic error message using SweetAlert2
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Terjadi kesalahan saat menambah data: ' + error
        });
      }
    });
  });
});

  function verifikasi(id_verifikasi) {
    $.ajax({
        type: "POST",
        url: "verifikasi_data.php", // Ensure this path is correct
        data: { id_verifikasi: id_verifikasi },
        dataType: 'json', // Expect JSON response from the server
        success: function(response) {
            if (response.success) {
                // Show success message using SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        $('#status_verifikasi_' + id_verifikasi).text('Terverifikasi'); // Update status in the table
                    }
                });
            } else {
                // Show error message using SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.error
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", xhr, status, error);
            // Show generic error message using SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan saat memverifikasi: ' + error
            });
        }
    });
}

function hapus_verifikasi(id_verifikasi, btn) {
  // Show confirmation dialog using SweetAlert2
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: "Data akan dihapus secara permanen!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Proceed with AJAX delete request
      $.ajax({
        type: 'POST',
        url: 'delete/hapus_verifikasi.php',
        data: { id_verifikasi: id_verifikasi },
        success: function(response) {
          const res = JSON.parse(response);
          if (res.success) {
            // Show success message using SweetAlert2
            Swal.fire({
              icon: 'success',
              title: 'Deleted!',
              text: 'Data berhasil dihapus.'
            }).then((result) => {
              if (result.isConfirmed || result.isDismissed) {
                $(btn).closest('tr').remove(); // Remove row from table
              }
            });
          } else {
            // Show error message using SweetAlert2
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Gagal menghapus data: ' + res.error
            });
          }
        },
        error: function(xhr, status, error) {
          console.error('Error details:', xhr, status, error);
          // Show generic error message using SweetAlert2
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan saat menghapus data: ' + error
          });
        }
      });
    }
  });
}

</script>
