<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if(!$_SESSION['nama']){
  header('Location: ../index.php?session=expired');
}
include('header.php');?>
<?php include('../conf/config.php');?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <?php include('preloader.php');?>

  <!-- Navbar -->
  <?php include('navbar.php');?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php include('logo.php');?>

    <!-- Sidebar -->
    <?php include('sidebar.php');?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include('content_header.php');?>
    <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php 
    if (isset($_GET['page'])){
    if ($_GET['page']=='dashboard'){
    include('.php');
    }
    else if($_GET['page']=='data-pelaku'){
      include('data_pelaku.php');
    }
    else if($_GET['page']=='edit-data'){
      include('edit/edit_data.php');
    }
    else if($_GET['page']=='data-indikator'){
      include('data_indikator.php');
    }
    else if($_GET['page']=='edit-indikator'){
      include('edit/edit_indikator.php');
    }
    else if($_GET['page']=='data-transaksi'){
      include('data_transaksi.php');
    }
    else if($_GET['page']=='edit-transaksi'){
      include('edit/edit_transaksi.php');
    }
    else if($_GET['page']=='verifikasi'){
      include('verifikasi.php');
    }
    else if($_GET['page']=='edit-verifikasi'){
      include('edit/edit_verifikasi.php');
    }
    else if($_GET['page']=='validasi'){
      include('validasi.php');
    }
    else if($_GET['page']=='edit-validasi'){
      include('edit/edit_validasi.php');
    }
    // else if($_GET['page']=='validasi-data'){
    //   include('validate/validasi_data.php');
    // }
    else if($_GET['page']=='data-training'){
      include('data_training.php');
    }
    else if($_GET['page']=='edit-training'){
      include('edit/edit_training.php');
    }
    else if($_GET['page']=='data-testing'){
      include('data_testing.php');
    }
    else if($_GET['page']=='edit-testing'){
      include('edit/edit_testing.php');
    }
    else if($_GET['page']=='penilaian'){
      include('penilaian.php');
    }
    else if($_GET['page']=='edit-penilaian'){
      include('edit/edit_penilaian.php');
    }
    else if($_GET['page']=='hasil-akhir'){
      include('hasil_akhir.php');
    }
    else if($_GET['page']=='tindak-lanjut'){
      include('tindak_lanjut.php');
    }
    else{
      include('not_found.php');
    }
  }
  else{
    include('dashboard.php');
  }?>
    <!-- Main content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</body>
</html>
