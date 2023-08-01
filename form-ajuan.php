<?php 
session_start(); 
// error_reporting(0);
include 'connection.php';


require 'dompdf example/dompdf/autoload.inc.php';
require 'verifikasi/vendor/autoload.php';
require 'verifikasi/src/PHPMailer.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

if (isset($_POST['buat'])) {

  $nama = $_POST['nama'];
  $nisn = $_POST['nisn'];
  $username = $_POST['nama'];
  $password = md5($_POST['nama']);
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $alamat = $_POST['alamat'];
  $jumlah = $_POST['jumlah'];
  $tanggal_pinjam = $_POST['tanggal_pinjam'];
  $tanggal_kembali = $_POST['tanggal_kembali'];
  $email=$_POST['email'];
  // 
  $id_buku = $_POST['id'];

  $cek=mysqli_query($conn,"SELECT * FROM buku WHERE id='$id_buku'");
  $cekdata=mysqli_fetch_assoc($cek);

  if ($jumlah>$cekdata['stok']) {
    echo "<script>
    alert('Jumlah Pinjam melebihi Stok, Pinjam maksimal $cekdata[stok] Buku')
    window.history.go(-1)
    </script>";
  }else{
    $cek_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nama = '$nama' AND nisn = '$nisn'");
    if (mysqli_num_rows($cek_siswa)) {
      $id_siswa = mysqli_fetch_assoc($cek_siswa);
      $query = mysqli_query($conn, "INSERT INTO peminjaman VALUES ('','$id_buku','$id_siswa[id_user]','$_POST[jumlah]','$tanggal_pinjam','$tanggal_kembali','1','F')");
      $id_peminjaman = mysqli_insert_id($conn);

      $cek_buku = mysqli_query($conn,"SELECT siswa.nama AS nama, peminjaman.jumlah, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, buku.kode_peminjaman, buku.judul_buku AS buku FROM peminjaman INNER JOIN buku ON peminjaman.id_buku = buku.id JOIN siswa ON siswa.id_user=peminjaman.id_siswa WHERE peminjaman.id='$id_peminjaman'");
      $field_buku = mysqli_fetch_assoc($cek_buku);
      try {

        function generatePDFFromView($viewPath, $data = []) {
    extract($data); // Extract data array into variables
    $dompdf = new Dompdf();
    ob_start();
    include $viewPath;
    $html = ob_get_clean();

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // You can set paper size and orientation here
    $dompdf->render();

    return $dompdf->output();
  }

  // Set dynamic data to be used in the view
  $kode_peminjaman = $field_buku['kode_peminjaman'];
  $buku = $field_buku['buku'];
  $pinjam = date('j F Y', strtotime($tanggal_pinjam));
  $back = date('j F Y', strtotime($tanggal_kembali));
  date_default_timezone_set('Asia/Jakarta');  
  $kembali = new DateTime($tanggal_kembali);
  $tenggat = new DateTime(date('Y-m-d'));
  $t = $tenggat->diff($kembali)->days+0;
  if ($tanggal_kembali<date('Y-m-d')) {
    $telat = "Telat ".$t." Hari";
  }elseif ($tanggal_kembali == date('Y-m-d')) {
    $telat = "Hari ini. ".$t." Hari";
  }else{
    $telat = $t." Hari";
  }

  $text_body = "Dear ".$nama.",<br><br>Terima kasih telah melakukan peminjaman buku di perpustakaan kami. Berikut adalah detail peminjaman Anda:<br><br>Judul Buku: $buku<br>Tanggal Peminjaman: $pinjam<br>Tanggal Pengembalian: $back<br><br>Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.<br><br>Terima kasih atas kerjasama Anda dan selamat membaca!<br><br>Salam,<br>Tim Perpustakaan SMP Wiyata Mandala";

  $viewPath = 'pages/peminjaman/sendmail/index.php';

  $pdfContent = generatePDFFromView($viewPath, ['nama' => $nama, 'email' => $email, 'pinjam'=>$pinjam,'back'=>$back,'jumlah'=>$jumlah,'kode_peminjaman'=>$kode_peminjaman,'buku'=>$buku,'telat'=>$telat]);

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'perpussmpwiyatamandala@gmail.com';                     //SMTP username
    $mail->Password   = 'rvqwdxfbbywzemxi';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = 
    $mail->setFrom('perpussmpwiyatamandala@gmail.com', 'no reply');
    $mail->addAddress($email, $nama);     //Add a recipient
    $mail->addStringAttachment($pdfContent, 'KARTU PEMINJAMAN.pdf', 'base64', 'application/pdf');

    $mail->Subject = 'PEMINJAMAN BUKU';
    $mail->Body    = $text_body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $viewFilePath = 'pages/peminjaman/sendmail/index.php';
    $viewContent = file_get_contents($viewFilePath);

    $mail->send();
    $_SESSION['emailverif']=$_POST['email'];
    $statusfalse=true;

  }
  catch (Exception $e) {
    echo "Koneksi ke Gmail Anda Error: {$mail->ErrorInfo}";
  }

  if ($query) {
    echo "<script>alert('Berhasil mengajukan peminjaman Buku')
    document.location.href='login.php'
    </script>";
  }else{
    echo "<script>alert('Gagal mengajukan peminjaman Buku')
    document.location.href='form-ajuan.php'
    </script>";
  }
  }else{
  echo "<script>
  document.location.href='form-ajuan.php?message=warning'
  </script>";
  }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Form Ajuan Peminjaman Buku</title>

  
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

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-sm-12">
            <div class="home-tab">
              <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                  <div class="row">
                    <div class="col-lg-12 d-flex flex-column">
                      <?php if (isset($_GET['message'])): ?>
                        <div class="alert alert-warning" role="alert">
                          <i class="mdi mdi-information"></i> Anda belum terdaftar di database Perpustakaan SMP Wiyata Mandala, hubungi Admin jika ini kesalahan sistem.
                        </div>
                      <?php endif ?>
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <h4 class="card-title">Form Pengajuan Peminjaman Buku</h4>
                              <form method="post" class="forms-sample">
                                <div class="row">

                                  <div class="col-lg-4">    
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Nama <span class="text text-danger"><b>*</b></span></label>
                                      <input type="text" required class="form-control" required="" name="nama" id="exampleInputUsername1" placeholder="Nama">
                                    </div>
                                  </div>
                                  <div class="col-lg-4">    
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Email <span class="text text-danger"><b>*</b></span></label>
                                      <input type="email" required class="form-control" autocomplete="off" required="" name="email" id="email" placeholder="Masukkan Email">
                                      <small id="validasi_email" class="text text-danger"></small>
                                    </div>
                                  </div>
                                  <div class="col-lg-4">    
                                    <div class="form-group">
                                     <label for="exampleInputUsername1">NISN <span class="text text-danger"><b>*</b></span></label>
                                     <input type="number" required class="form-control" required="" name="nisn" id="exampleInputUsername1" placeholder="NISN">
                                   </div>
                                 </div>
                                 <div class="col-lg-12">    
                                  <div class="form-group">
                                    <label>Judul Buku <span class="text text-danger"><b>*</b></span></label>
                                    <select class="form-control" name="id" required="" >
                                      <option value="">-- PILIH BUKU --</option>
                                      <?php
                                      $result = mysqli_query($conn, "SELECT * FROM buku");   
                                      ?>   
                                      <?php foreach ($result as $row): ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['judul_buku'] ?></option>
                                      <?php endforeach ?>
                                    </select> 
                                  </div>  
                                </div>
                                <div class="col-lg-4">    
                                  <div class="form-group">
                                   <label for="exampleInputUsername1">Jumlah Pinjam <span class="text text-danger"><b>*</b></span></label>
                                   <input type="number" required class="form-control" required="" name="jumlah" id="exampleInputUsername1">
                                 </div>
                               </div>
                               <div class="col-lg-4">    
                                <div class="form-group">
                                 <label for="exampleInputUsername1">Tanggal Pinjam <span class="text text-danger"><b>*</b></span></label>
                                 <input type="date" required class="form-control" required="" name="tanggal_pinjam" id="exampleInputUsername1">
                               </div>
                             </div>
                             <div class="col-lg-4">    
                              <div class="form-group">
                               <label for="exampleInputUsername1">Tanggal Kembali <span class="text text-danger"><b>*</b></span></label>
                               <input type="date" required class="form-control" required="" name="tanggal_kembali" id="exampleInputUsername1">
                             </div>
                           </div>
                         </div>
                         <div class="form-group row">
                          <div class="col-sm-6">
                           <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" required="" name="jenis_kelamin" id="membershipRadios1" value="Laki-Laki">
                              Laki-Laki
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                           <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" required="" name="jenis_kelamin" id="membershipRadios2" value="Perempuan">
                              Perempuan
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                         <label for="exampleTextarea1">Alamat</label>
                         <textarea class="form-control" style="height: 100%;" required="" name="alamat" rows="8"></textarea>
                       </div>
                       <button type="submit" name="buat" onclick="return confirm('Lanjutkan')" class="text-white btn btn-primary me-2">Submit</button>
                       <button type="reset" class="btn btn-light me-2">Reset</button>
                       <a href="javascript:window.history.back()" class="btn btn-warning me-2">Kembali</a>
                     </form>                
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
<script>
  $(document).ready(function() {
    var email = document.getElementById('email');
    // var submit = document.getElementById('submit');
    email.addEventListener('keyup',function() {
      var mail=$('#email').val();
      var atps=mail.indexOf("@");
      var dots=mail.lastIndexOf(".");
      if (mail !== "") {
        if (atps<1 || dots<atps+2 || dots+2>=mail.length || !document.getElementById("email").checkValidity()) {
          document.getElementById('validasi_email').innerHTML = "Masukkan alamat email dengan valid";
          // submit.disabled = true;
        }else{
          // submit.disabled = false;
          document.getElementById('validasi_email').innerHTML = "";
        }
      }else{
        // submit.disabled = false;
        document.getElementById('validasi_email').innerHTML = "";
      }
    })
  })
</script>
</html>
