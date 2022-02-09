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


<html lang="en" style="height: auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UKK RPL 2022 | Aplikasi Peduli Diri</title>
    <link
      rel="stylesheet"
      href="assets/plugins/fontawesome-free/css/all.min.css"
    />
    <link rel="icon" href="assets/img/favicon.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css" />
    <link
      rel="stylesheet"
      href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
    />
    <link rel="stylesheet" href="style.css">
  </head>
  <body
    class="sidebar-mini sidebar-closed sidebar-collapse"
    style="height: auto"
  >
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
              ><i class="fas fa-bars"></i
            ></a>
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

      <script src="assets/plugins/jquery/jquery.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/dist/js/adminlte.min.js"></script>
      <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
      <!-- Content -->
      <div class="content-wrapper" style="min-height: 502px">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>
                  Catatan Perjalanan
                  <?php echo htmlspecialchars($_SESSION['nama']);?>
                </h1>
              </div>
            </div>
          </div>
        </section>

        
    <?php
        if(isset($_GET['page']) && $_GET['page'] === 'tulis_catatan'){
            ?>

            <section class="content">
            <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Tulis Catatan</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Pilih Tanggal</label>
                <div class="col-sm-8">
                <input type="date" class="form-control" name="tanggal" required="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Pilih Jam</label>
                <div class="col-sm-8">
                <input type="time" class="form-control" name="jam" required="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Lokasi Yang Dikunjungi</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="lokasi" placeholder="Masukkan Lokasi" required="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Suhu Tubuh</label>
                <div class="col-sm-8">
                <input type="number" class="form-control" name="suhu" placeholder="Masukkan Suhu Tubuh (Celcius)" required="">
                </div>
            </div>
            </div>
            <div class="card-footer">
            <button id="submit" class="btn btn-primary float-right m-2"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" id="reset" class="btn btn-danger float-right m-2"><i class="fa fa-trash"></i> Kosongkan</button>
            </div>
        </div>
        </div>

            </section>
        <script>
            (function(){
                document.getElementById('reset').onclick = function (){
                    Array.from(document.getElementsByTagName('input')).forEach(x => {
                        x.value = '';
                    })
                }
                document.getElementById('submit').onclick = function (){
                    const form = new FormData();
                    Array.from(document.getElementsByTagName('input')).forEach(x => {
                        form.append(x.name, x.value);
                    })
                    fetch('api/buat_catatan.php', {
                        method: 'POST',
                        body: form
                    }).then(async (resp)=>{
                        const rjson = await resp.json();
                        Swal.fire({
                            position: 'top-end',
                            icon: rjson.status?'success':'error',
                            title: `Catatan ${rjson.status?'Berhasil': 'Gagal'} Di Tambahkan`,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        rjson.status && document.getElementById('reset').click();
                    });
                }
            })()
        </script>
        <?php
    } else if(isset($_GET['page']) && $_GET['page'] === 'riwayat_perjalanan'){

        ?>

      <section class="content">
        <div class="card card-primary">
            <!-- /.card-header -->
            <div class="card-header">
                <h3 class="card-title">Riwayat Perjalanan</h3>
            </div>
            <div class="card-body" style="overflow-y: scroll;overflow-x: auto;">
                <table id="table-data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Lokasi Berkunjung</th>
                    <th>Suhu Tubuh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach($user->lihat_catatan() as $catatan){
                        echo "
                        <tr>
                        <td>".$count."</td>
                        <td>".htmlspecialchars($catatan["tanggal"])."</td>
                        <td>".htmlspecialchars($catatan["jam"])."</td>
                        <td>".htmlspecialchars($catatan["lokasi"])."</td>
                        <td>".htmlspecialchars($catatan["suhu"])." Celcius</td>
                        </tr>
                        ";
                        $count++;
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
      </section>
      <script>
    (function(){
        $("#table-data").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "paging": true, "pageLength": 5
      })
    })();
</script>

        <?php
        }else{

?>


      <section class="content">
         <div class="callout callout-info">
            <h5>Aplikasi Peduli Diri</h5>
            <p>
              Dibuat oleh : <strong><a style="color: gray;" href="https://github.com/krypton-byte" target="_blank" rel="noopener noreferrer">Puja</a></strong> <br>
              Untuk Memenuhi Uji Kompetensi Keahlian Rekayasa Perangkat Lunak (RPL) Tahun Pelajaran 2021/2022
            </p>
          </div>

                    
          <div class="row">
            <div class="col-6">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3><?php echo $user->catatan()?></h3>
                  <p>Total Catatan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-alt"></i>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $user->user()?></h3>
                  <p>Total Pengguna</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
              </div>
            </div>
          </div>
      </section>
<?php
}
?>
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
<div id="sidebar-overlay"></div>
</div>
</body>
</html>