<?php
require_once '../assets/configuration/konek.php';
session_start();
if (empty($_SESSION['username'])) {
  header("Location: ../manage/index.php");
}
?>
<div class="app-wrapper">
  <?php require_once('../tpl/header.php'); ?>
  <?php require_once('../tpl/sidebar.php'); ?>
  <main class="app-main">
    <div class="app-content">
      <div class="container-fluid">
        <div class="row mt-3">
          <div class="col-lg col-6">
            <div class="card box-primary">
              <div class="content p-4">
                <div class="box-header mb-3">
                  <div class="d-flex justify-content-between">
                    <h3 class="box-title"> Detail Disposisi Surat </h3>
                    <a href="disposisi.php" class="btn btn-secondary me-2"> Kembali </a>
                  </div>
                </div>
                <div class="box-body">
                  <?php
                  if (isset($_GET['detaildispo'])) {
                    $kd = $_GET['detaildispo'];
                    $tampilkan = mysqli_query($konek, "select * from surat_masuk where no_sumas='$kd'");
                    $fak = mysqli_fetch_array($tampilkan);
                  }
                  ?>
                  <embed src="upload_sumas/<?php echo $fak['10']; ?>" width="100%" height="500px" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<?php require_once('../tpl/about.php'); ?>
<?php require_once('../tpl/footer.php'); ?>