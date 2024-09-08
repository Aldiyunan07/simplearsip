<?php
include 'assets/configuration/konek.php';
session_start();
error_reporting(0);
?>

<?php
$quer2 = mysqli_query($konek, "select * from config");

if (mysqli_num_rows($quer2) > 0) {
?>

  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <title>PKLK | MailTrack</title>
    <style>
      .body-ingin {
        background-image: url('img/pklk.jpg');
        /* Ganti dengan path gambar Anda */
        background-size: cover;
        /* Mengatur gambar agar menutupi seluruh layar */
        background-repeat: no-repeat;
        /* Menghindari pengulangan gambar */
        background-position: center;
        /* Memposisikan gambar di tengah */
        height: 100vh;
        /* Menutupi seluruh tinggi viewport */
        display: flex;
        /* Menggunakan flexbox untuk center alignment */
        justify-content: center;
        /* Menempatkan konten di tengah horizontal */
        align-items: center;
        /* Menempatkan konten di tengah vertikal */
      }

      .modal-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-bottom: none;
        /* Menghilangkan garis bawah di header */
      }
    </style>
  </head>

  <body class="body-ingin">

    <div class="container">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <img src="img/logopklk.jpg" alt="Logo PKLK" style="width:100px; height:auto;">
            <h4 class="modal-title mt-3">
              <font color="black">Mail Track</font>
            </h4>
          </div>
          <div class="modal-body">
            <?php
            if (isset($_POST['login'])) {
              $username = $_POST['userlog'];
              $password = $_POST['passlog'];

              $query = mysqli_query($konek, "select * from pegawai where username='$username' and password='$password'");
              $coba = mysqli_fetch_array($query);
              if ($coba == TRUE) {
                $_SESSION['username'] = $username;
                $_SESSION['level'] = $coba['level'];
                $_SESSION['no_peg'] = $coba['no_peg'];
                $_SESSION['photo'] = $coba['photo'];
                header("Location: manage/index.php");
              } else {
            ?><center>
                  <font class="alert alert-danger modal-title">Login gagal, username/password salah.</font>
                </center><br>
            <?php
              }
            }
            ?>
            <form method="POST">
              <div class="form-group">
                <label for="exampleInputEmail1">Username :</label>
                <input type="text" class="form-control" id="exampleInputUsername" name="userlog" placeholder="masukkan username...">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="passlog" placeholder="masukkan password...">
              </div>
              <div class="form-check mb-2 mr-sm-2">
                <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                <label class="form-check-label" for="inlineFormCheck">
                  Remember me
                </label>
              </div>
          </div>
          <div class="modal-footer">
            <button name="login" class="btn btn-outline-success">Log-In</button>
            <a href="lupa.php" class="btn btn-outline-danger">Lupa Password?</a>
            </form>
          </div>
        </div>
      </div>
      <br>
      <center>
        <font>Copyright &copy; 2024. AnMagangITG</font>
      </center>
    </div>

  </body>
  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="assets/js/jquery.slim.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  </html>
<?php
} else {
  echo "<script>window.location.href='regis.php';</script>";
}
?>