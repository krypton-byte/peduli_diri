<?php
    session_start();
    if($_SESSION['nik'] && $_SESSION['nama']){
        require 'Engine/csv.php';
        try{
            $user = new User($_SESSION['nik'], $_SESSION['nama']);
            $user->Masuk();
        }catch(Exception $e){
            header('location: logout.php');
            exit();
        }
    }else{
        header('location: index.php');
        exit();
    }?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UKK RPL 2022 | Aplikasi Peduli Diri</title>
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="icon" href="assets/img/favicon.png" sizes="16x16" type="image/png">
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
        <a href="#" class="brand-link">
          <img
            src="assets/img/logo.png"
            alt="Peduli Diri"
            class="brand-image"
          />
          <span class="brand-text font-weight-light">Aplikasi Peduli Diri</span>
        </a>
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                src="assets/img/user.jpg"
                class="img-circle"
                alt="User Image"
              />
            </div>
            <div class="info">
              <a href="#" class="d-block"
                ><?php echo htmlspecialchars($_SESSION['nama']);?></a
              >
            </div>
          </div>

          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item">
                <a href="user.php" class="nav-link">
                <i class="nav-icon fas fa-solid fa-house-user"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=tulis_catatan" class="nav-link">
                <i class="nav-icon fas fa-solid fa-pen"></i>
                  <p>Tulis Catatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=riwayat_perjalanan" class="nav-link">
                  <i class="nav-icon fa fa-book"></i>
                  <p>Riwayat Perjalanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link">
                <i class="nav-icon fas fa-solid fa-door-closed"></i>
                  <p>Keluar</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </aside>

    <!-- Content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Catatan Perjalanan <?php echo $_SESSION['nama'] ?></h1>
            </div>
          </div>
        </div>
      </section>
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dist/js/adminlte.min.js"></script>
  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

      <section class="content">

        
    <?php
    if(empty($_GET['page']) || !(isset($_GET['page']))){
      include 'components/home.php';
    }else{
      switch($_GET['page']){
        case 'tulis_catatan':
            include 'components/tuliscatatan.php';
            break;
        case 'riwayat_perjalanan':
          include 'components/riwayat.php';
          break;
        default:
          echo '<h3>Halaman Tidak Ditemukan!</h3>';
          break;
      }
    }
?>
        </section>
    </div>

    <footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>UKK RPL 2022</b> Aplikasi Peduli Diri
  </div>
  <strong
    >Copyright © <?php echo date('Y')?>
    <a href="https://rpl.smkn1panyingkiran.sch.id"
      >RPL SMKN 1 Panyingkiran</a
    >.</strong
  >
  <a style="color:gray;" href="https://github.com/krypton-byte" target="_blank" rel="noopener noreferrer">Puja</a>
</footer>

  </div>



</body>
</html>
