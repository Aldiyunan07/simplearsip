<?php
session_start();
if (empty($_SESSION['username'])) {
  header("Location: ../index.php");
}
include '../assets/configuration/konek.php';
if (isset($_GET['id'])) {
  $kd_sukel = $_GET['id'];
  $sukel = mysqli_query($konek, "SELECT * FROM surat_keluar WHERE kd_sukel='$kd_sukel' LIMIT 1");
  $data = mysqli_fetch_assoc($sukel);
}

if (isset($_POST['update'])) {
  $kd_sukel = $_POST['kd_sukel'];
  $no_sukel = $_POST['no_sukel'];
  $tgl_sukel = $_POST['tgl_sukel'];
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $instansi = $_POST['instansi'];
  $update = mysqli_query($konek, "UPDATE surat_keluar SET
    no_sukel = '$no_sukel',
    tgl_sukel = '$tgl_sukel',
    judul_sukel = '$judul',
    isi_sukel = '$isi',
    instansi = '$instansi'
    WHERE kd_sukel = '$kd_sukel'
  ");
  if ($update) {
    echo "<script> alert('Berhasil mengupdate surat masuk!!');</script>";
    echo "<script>window.location.href='surat-keluar.php'</script>";
  } else {
    echo "<script> alert('Gagal mengupdate surat masuk!!');</script>";
  }
}
?>
<div class="app-wrapper">
  <?php require_once('../tpl/header.php'); ?>
  <?php require_once('../tpl/sidebar.php'); ?>
  <main class="app-main">
    <div class="app-content">
      <div class="container-fluid">
        <div class="row mt-3">
          <div class="col-lg-12">
            <div class="card">
              <div class="p-2">
                <div class="card-header">
                  <h4>Edit Surat Keluar</h4>
                </div>
                <form action="" enctype="multipart/form-data" method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Kode Surat</label>
                          <input name="kd_sukel" type="text" class="form-control" value="<?= $data['kd_sukel'] ?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="">Nama Instansi / Pengirim</label>
                          <input name="instansi" type="text" class="form-control" value="<?= $data['instansi'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Tanggal Surat</label>
                          <input name="tgl_sukel" type="date" id="tanggal" class="form-control" value="<?= $data['tgl_sukel'] ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">No Surat</label>
                          <input name="no_sukel" type="text" class="form-control" value="<?= $data['no_sukel'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Subject</label>
                          <input name="judul" type="text" class="form-control" value="<?= $data['judul_sukel'] ?>">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Isi Surat</label>
                          <textarea name="isi" class="form-control" id=""><?= $data['isi_sukel'] ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="d-flex justify-content-end">
                      <a href="surat-keluar.php" class="btn me-2 btn-secondary">Cancel</a>
                      <button name="update" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>