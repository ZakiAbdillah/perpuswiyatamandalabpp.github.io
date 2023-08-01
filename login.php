<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login</title>

  
   <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  </head>
  <?php 
  include 'connection.php';

  error_reporting(0);
  
  session_start(); 
  
  if($_SESSION['username'] != null) 
  {
    switch($_SESSION['role']) 
    {
      case $_SESSION['role'] == 'admin':
        header("location:pages/index.php");
        break;
      case $_SESSION['role'] == 'user':
        header("location:pages/book/index.php");
        break;
      default:
        header("location:index.php");
    }
  }
  
  
  ?>
  <body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/logo.svg" alt="logo">
              </div>
              <h4>Login terlebih dahulu</h4>
              <form class="pt-3" action="func/login.php" method="POST">
              <?php 
                  if(isset($_GET['pesan'])){
                    if($_GET['pesan']=="gagal"){ ?>
                    <div class="alert alert-danger" role="alert">
                      <div class='alert'>Username dan Password tidak sesuai !</div>
                    </div>
                    <?php }
                  }
                  ?>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" required="" id="exampleInputEmail1" name="username"  placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" required="" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Sign in</button>
                  <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y')  ?></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->



     <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    
  </body>
</html>
