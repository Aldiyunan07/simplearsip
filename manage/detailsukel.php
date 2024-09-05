<?php
session_start();
if (empty($_SESSION['username'])) {
  header("Location: ../index.php");
}
?>
<div class="app-wrapper">
  <?php require_once('../tpl/header.php'); ?>
  <?php require_once('../tpl/sidebar.php'); ?>
  <main class="app-main">
    <div class="app-content">
      <div class="container-fluid">
        <div class="row mt-3">
          <div class="col-">
            <a href="surat-keluar.php" class="btn btn-primary">
              <font class="bi bi-arrow-left">Kembali</font>
            </a><br><br>
            <div class="panel panel-default table-responsive">
              <form action="" method="get">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>No Surat</th>
                      <th>Tgl Surat</th>
                      <th>Instansi</th>
                    </tr>
                  </thead>
                  <?php
                  if (isset($_GET['details'])) {
                    $kode = $_GET['details'];
                    $tampilkan = mysqli_query($konek, "select * from surat_keluar where kd_sukel='$kode'"); {
                      $r = mysqli_fetch_array($tampilkan);
                    }
                  }
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $r['1']; ?></td>
                      <td><?php echo $r['2']; ?></td>
                      <td><?php echo $r['3']; ?></td>
                      <td><?php echo $r['4']; ?></td>
                    </tr>
                  </tbody>

                  <thead>
                    <tr>
                      <th>Judul Surat :</th>
                      <th>File :</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $r['5']; ?></td>
                      <td><a href="upload_sukel/<?php echo $r['7']; ?>"><?php echo $r['7']; ?></a></td>
                    </tr>
                  </tbody>

                  <thead>
                    <tr>
                      <th>Deskripsi Surat :</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><textarea class="form-control" readonly><?php echo $r['6']; ?></textarea></td>
                    </tr>
                  </tbody>

                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>


<?php require_once('../tpl/sumas.php'); ?>
<?php require_once('../tpl/sukel.php'); ?>
<?php require_once('../tpl/footer.php'); ?>