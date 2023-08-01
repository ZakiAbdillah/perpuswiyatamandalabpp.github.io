<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta property="og:image" content="{{asset('foto')}}/{{$dt->logo}}">
  <title>SMP Wiyata Mandala</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="shortcut icon" type="image/x-generic" href="{{asset('foto')}}/{{$dt->logo}}">
  <!-- Favicons -->
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="public/green/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="public/green/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="public/green/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="public/green/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="public/green/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="public/green/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">    

  <!-- Template Main CSS File -->
  <link href="public/green/assets/css/style.css" rel="stylesheet">
  <link href="public/green/assets/css/styletwo.css" rel="stylesheet">

</head>
<style type="text/css">
#drop:hover{
  color: #f73859;
}
#preloader {
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 99999999999;
  background: #fff; 
}

.loader {
  position: absolute;
  width: 10rem;
  height: 10rem;
  top: 50%;
  margin: 0 auto;
  left: 0;
  right: 0;
  transform: translateY(-50%); 
}
</style>
<body>
  <div itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
    <meta content="{{asset('foto')}}/{{$dt->logo}}" itemprop="url"/> </div>

    <div id="preloader">
      <div class="loader">
        <center>
          Mohon Menunggu ...
          <!-- <img src="{{asset('foto')}}/{{$dt->logo}}" width="60"> -->
        </center>
      </div>
    </div>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
      <div class="container d-flex align-items-center">

        <!-- <h1 class="logo me-auto"><a href=""><img src="{{asset('foto')}}/{{$dt->logo}}" ></a></h1> -->
        <h1 class="logo me-auto text-center">SMP Wiyata Mandala</h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="public/green/assets/img/logo.png')}}" alt="" class="img-fluid"></a>-->

        

      </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">


        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active">
            <div class="carousel-container">
              <div class="container">
                <img src="images/logo.png" width="50">
                <h2 class="animate__animated animate__fadeInDown">SMP WIYATA MANDALA BALIKPAPAN</h2>
                <p class="animate__animated animate__fadeInUp">Selamat datang di Web Perpustakaan SMP Wiyata Mandala. Lihat dan Pinjam buku jadi lebih mudah!</p>
                <a href="book.php" class="btn-get-started animate__animated animate__fadeInUp scrollto">LIHAT DAFTAR BUKU <i class="bx bx-book"></i></a>
                <a href="form-ajuan.php" class="btn-get-started animate__animated animate__fadeInUp scrollto">PENGAJUAN PEMINJAMAN <i class="bx bx-pencil"></i></a>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->

        </div>

      </div>
    </section><!-- End Hero -->

    <main id="main">



    </main><!-- End #main -->


    <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

    <!-- Vendor JS Files -->
    <script src="public/green/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/green/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="public/green/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="public/green/assets/vendor/php-email-form/validate.js"></script>
    <script src="public/green/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="public/green/jquery.min.js"></script>
    <!-- Template Main JS File -->
    <script src="public/green/assets/js/main.js"></script>
    <script type="text/javascript">
      jQuery(window).on("load", function() {
        $('#preloader').fadeOut(1000);
        $('#main-wrapper').addClass('show');

        $('body').attr('data-sidebar-style') === "mini" ? $(".hamburger").addClass('is-active') : $(".hamburger").removeClass('is-active')
      });
    </script>
  </body>
  </html>
