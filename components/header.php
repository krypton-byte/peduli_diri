<html lang="en" style="height: auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UKK RPL 2022 | Aplikasi Peduli Diri</title>
    <link
      rel="stylesheet"
      href="assets/plugins/fontawesome-free/css/all.min.css"
    />
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css" />
    <link
      rel="stylesheet"
      href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
    />
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
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
          <img
            src="assets/img/logo.png"
            alt="Peduli Diri"
            class="brand-image img-circle"
          />
          <span class="brand-text font-weight-light">Aplikasi Peduli Diri</span>
        </a>

        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                src="assets/img/user.png"
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
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=tulis_catatan" class="nav-link">
                  <i class="nav-icon fas fa-pencil-alt"></i>
                  <p>Tulis Catatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=riwayat_perjalanan" class="nav-link">
                  <i class="nav-icon fa fa-clone"></i>
                  <p>Riwayat Perjalanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link">
                  <i class="nav-icon fas fa-power-off"></i>
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
                  <?php echo $_SESSION['nama'];?>
                </h1>
              </div>
            </div>
          </div>
        </section>
