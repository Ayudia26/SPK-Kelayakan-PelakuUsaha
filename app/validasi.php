<!-- Main content -->
<section class="content" style="background-color: pink;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Validasi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">Tambah Validasi</button>
                        <br></br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Validasi</th>
                                    <th>Id Verifikasi</th>
                                    <th>Tanggal Validasi</th>
                                    <th>Status Validasi</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 5005;
                                $query = mysqli_query($koneksi,"SELECT * FROM tb_validasi");
                                $nomor = 1; // Inisialisasi nomor baris
                                while($plk = mysqli_fetch_array($query)){
                                    $no++;
                                ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td> <!-- Kolom nomor baris -->
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $plk['id_verifikasi'];?></td>
                                    <td><?php echo $plk['tanggal_validasi'];?></td>
                                    <td id="status_validasi_<?php echo $plk['id_validasi']; ?>"><?php echo $plk['status_validasi']; ?></td>
                                    <!-- Button untuk verifikasi -->
                                     
                                    <td><?php echo $plk['keterangan'];?></td>
                                    <td>
                                    <button type="button" class="btn btn-primary" onclick="validasi(<?php echo $plk['id_validasi']; ?>)">Validasi</button>
                                    <button class="btn btn-sm btn-danger" onclick="hapus_validasi('<?php echo $plk['id_validasi']; ?>', this)">Hapus</button>
                                    <a href="index.php?page=edit-validasi&&id_validasi=<?php echo $plk['id_validasi'];?>" class="btn btn-sm btn-success">Edit</a>
                                    </td>
                                </tr>
                                <?php 
                                $nomor++; // Tingkatkan nomor baris setiap kali loop berjalan
                                }?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Id Validasi</th>
                                    <th>Id Verifikasi</th>
                                    <th>Tanggal Validasi</th>
                                    <th>Status Validasi</th>
                                    <th>Keterangan</th>
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
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Validasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="add/tambah_validasi.php">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Id Validasi" name="id_validasi" readonly>
                        </div>
                        <div class="col">
              <select class="form-control" name="id_verifikasi">
                <option selected>Pilih Pelaku</option>
                <?php
                $det = mysqli_query($koneksi, "SELECT * FROM tb_verifikasi");
                while ($d = mysqli_fetch_array($det)) {
                  ?>
                  <option value="<?php echo $d['id_verifikasi'] ?>"><?php echo $d['id_verifikasi'] ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
                        <div class="col">
                            <input type="date" class="form-control" placeholder="Tanggal Validasi" name="tanggal_validasi">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Status Validasi" name="status_validasi">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Keterangan" name="keterangan">
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

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function() {
    $('form').on('submit', function(event) {
      event.preventDefault();
      var form = this;

      $.ajax({
        type: $(form).attr('method'),
        url: $(form).attr('action'),
        data: $(form).serialize(),
        dataType: 'json', // Expect JSON response from the server
        success: function(response) {
          if (response.success) {
            // Show success message using SweetAlert2
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: 'Data validasi berhasil ditambahkan.',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed || result.isDismissed) {
                window.location.reload(); // Reload the page
              }
            });
          } else {
            // Show error message using SweetAlert2
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: 'Data gagal ditambahkan: ' + (response.error || 'Kesalahan tidak diketahui.'),
              confirmButtonText: 'OK'
            });
          }
        },
        error: function(xhr, status, error) {
          console.error("Error:", xhr, status, error);
          // Show generic error message using SweetAlert2
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan saat menambahkan data: ' + error
          });
        }
      });
    });
  });

  function validasi(id_validasi) {
    $.ajax({
        type: "POST",
        url: "validasi_data.php",
        data: { id_validasi: id_validasi },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        $('#status_validasi_' + id_validasi).text('Tervalidasi');
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.error
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", xhr, status, error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan saat memvalidasi: ' + error
            });
        }
    });
  }

  function hapus_validasi(id_validasi, row) {
    console.log("ID Validasi:", id_validasi);

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
        $.post('delete/hapus_validasi.php', { id_validasi: id_validasi }, function(data) {
          console.log("Response:", data);
          if (data.success) {
            Swal.fire({
              title: 'Berhasil!',
              text: 'Data berhasil dihapus.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              $(row).closest('tr').remove();
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
