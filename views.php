<?php  
include 'connection.php';
$result = mysqli_query($conn, "SELECT * FROM buku WHERE sampul_buku = '$_GET[utm]'");
if (isset($_POST["cari"])) {
  $result = cariBuku($_POST["keyword"]);
}if (empty($result)) {
  $kosong = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SMP Wiyata Mandala</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./vendors/feather/feather.css">
  <link rel="stylesheet" href="./vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="./vendors/typicons/typicons.css">
  <link rel="stylesheet" href="./vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="./vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="./js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./css/vertical-layout-light/style.css">
  <!-- endinject -->
  <!-- <link rel="shortcut icon" href="../images/favicon.png" /> -->
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row navbar-primary">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start" style="background: #4169E1;">
        <div class="me-3 text-white">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text text-white">Selamat Datang di <span class="text-black fw-bold"></span></h1>
            <h3 class="welcome-sub-text text-white">Perpustakaan SMP Wiyata Mandala</h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a href="login.php" class="btn btn-primary btn-md text-white mb-0 me-0">Login</a>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a href="form-ajuan.php" class="btn btn-primary btn-md text-white mb-0 me-0">Pengajuan Peminjaman</a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category">Buku</li>
          <li class="nav-item">
            <a class="nav-link" href="book.php">
              <i class="mdi mdi mdi-book-multiple"></i>
              <span class="menu-title">Buku</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                               <!--  <div class="d-sm-flex justify-content-between align-items-start">
                                  <form method="POST">
                                    <h4 class="card-title card-title-dash">
                                      <input type="search" class="form-control" placeholder="Cari Buku .." autocomplete="off" name="keyword">
                                      <button name="cari" class="btn tn-sm btn-primary mt-2 text-white">Cari</button>
                                    </h4>
                                  </form>
                                </div> -->
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Detail Buku</h4>
                                    <!-- <?php if (isset($kosong)): ?>
                                      <span class="badge bg-danger">Pencarian Buku <b><u><?php echo $_POST['keyword'] ?></u></b> tidak di temukan</span>
                                    <?php endif ?> -->
                                  </div>
                                </div>
                                <?php foreach ($result as $rows): ?>
                                  <div class="table-responsive  mt-1">
                                    <table class="table select-table">
                                      <tr>
                                        <th>Rak Buku</th>
                                        <td>:</td>
                                        <td><?php echo $rows['rak_buku'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Judul</th>
                                        <td>:</td>
                                        <td><?php echo $rows['judul_buku'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Kategori</th>
                                        <td>:</td>
                                        <td><?php echo $rows['kategori'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Penulis</th>
                                        <td>:</td>
                                        <td><?php echo $rows['penulis'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Penerbit</th>
                                        <td>:</td>
                                        <td><?php echo $rows['penerbit'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Tahun Terbit</th>
                                        <td>:</td>
                                        <td><?php echo $rows['tahun_terbit'] ?></td>
                                      </tr>
                                    </table>
                                  </div>
                                  <div class="row mt-3">
                                    <div class="col-lg-4">
                                      <img src="pages/book/image/<?php echo $rows['sampul_buku'] ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-lg-8">
                                      <?php echo "$rows[abstrak_buku]" ?>
                                    </div>
                                  </div>
                                <?php endforeach; ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-center">
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">SMP Wiyata Mandala © <?= date('Y') ?>. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="./vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="./vendors/chart.js/Chart.min.js"></script>
  <script src="./vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="./vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="./js/off-canvas.js"></script>
  <script src="./js/hoverable-collapse.js"></script>
  <script src="./js/template.js"></script>
  <script src="./js/settings.js"></script>
  <script src="./js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="./js/jquery.cookie.js" type="text/javascript"></script>
  <script src="./js/dashboard.js"></script>
  <script src="./js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

