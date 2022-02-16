<?php
session_start();
?>
<html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UKK RPL 2022 | Aplikasi Peduli Diri</title>
  <link rel="icon" href="assets/img/favicon.png" sizes="16x16" type="image/png">
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.css">
</head>
<body class="login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#">
        <img src="assets/img/logo.png" width="100px">
        <h1>Aplikasi Peduli Diri</h1>
      </a>
    </div>
    <div class="card">
      <div class="card-body login-card-body bg-transparent opacity-3">
        <p class="login-box-msg"><b style="color:black;">Buat Akun Baru</b></p>
        <form action="" method="POST">
        <?php
        if(isset($_POST['nik']) && isset($_POST['nama_lengkap'])){
            require 'Engine/csv.php';
            try{
                $user = new User($_POST['nik'], $_POST['nama_lengkap']);
                $user->Daftar();
                $_SESSION['pesan'] = 'Registrasi Berhasil';
                header('location: index.php');
            }catch(Exception $e){
                echo '<div class="alert alert-warning" role="alert">'.$e->getMessage().'</div>';
            }
        }
        if(isset($_SESSION['nik']) && isset($_SESSION['nama'])){
            header('location: user.php');
        }
        ?>
          <div class="input-group mb-3">
            <input type="number" name="nik" class="form-control" placeholder="Masukkan NIK" value="<?php echo array_key_exists('nik', $_POST)?$_POST['nik']:''?>" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-address-card"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" value="<?php echo array_key_exists('nama_lengkap', $_POST)?$_POST['nama_lengkap']:''?>" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <input type="submit" value="DAFTAR" name="daftar" class="btn btn-primary btn-block">
            </div>
          </div>
          <div>
            <a href="index.php" class="text-dark">Sudah Punya Akun? Klik disini!</a>
          </div>
        </form>
        <br>
        <center>Copyright © 2022 | SMKN 1 Panyingkiran</center>
      </div>
    </div>
  </div>

  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dist/js/adminlte.min.js"></script>

<style>
    body {
        background-image: url('assets/img/bg.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .card-body, .card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
    span {
      color: black;
    }
    h1 {
        color: white;
    }
    center{
      color:black;
    }
    .alert {
        opacity: 70%;
    }
</style>
</body></html>
