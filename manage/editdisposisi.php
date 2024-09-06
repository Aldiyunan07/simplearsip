<?php
session_start();
if (empty($_SESSION['username'])) {
  header("Location: ../index.php");
}
include '../assets/configuration/konek.php';
if (isset($_GET['id'])) {
  $no_disposisi = $_GET['id'];
  $disposisi = mysqli_query($konek, "SELECT * FROM disposisi WHERE no_disposisi='$no_disposisi' LIMIT 1");
  $data = mysqli_fetch_assoc($disposisi);
  $pegawai = mysqli_query($konek, "SELECT * FROM pegawai");
  $sumas = mysqli_query($konek, "SELECT * FROM surat_masuk");
}

if (isset($_POST['update'])) {
  $no_sumas = $_POST['no_sumas'];
  $tgl_dispo = $_POST['tgl_dispo'];
  $penerima = $_POST['penerima'];
  $judul = $_POST['judul'];
  $catatan = $_POST['catatan'];
  $update = mysqli_query($konek, "UPDATE disposisi SET
    no_sumas = '$no_sumas',
    tgl_dispo = '$tgl_dispo',
    penerima = '$penerima',
    judul = '$judul',
    catatan = '$catatan'
    WHERE no_disposisi = '$no_disposisi'
  ");
  if ($update) {
    echo "<script> alert('Berhasil mengupdate disposisi!!');</script>";
    echo "<script>window.location.href='disposisi.php'</script>";
  } else {
    echo "<script> alert('Gagal mengupdate disposisi!!');</script>";
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
                  <h4>Edit Disposisi</h4>
                </div>
                <form action="" enctype="multipart/form-data" method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">No Disposisi</label>
                          <input name="no_disposisi" type="text" class="form-control" value="<?= $data['no_disposisi'] ?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="">Tanggal Disposisi</label>
                          <input name="tgl_dispo" type="date" id="tanggal" class="form-control" value="<?= $data['tgl_dispo'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Subject</label>
                          <input name="judul" type="text" class="form-control" value="<?= $data['judul'] ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">No Surat Masuk</label>
                          <select name="no_sumas" id="" class="form-control">
                            <?php
                            while ($d = mysqli_fetch_array($sumas)) {
                              if ($data['no_sumas'] == $d['no_sumas']) {
                                $selected = 'selected';
                              } else {
                                $selected = '';
                              }
                              echo "<option $selected value='$d[no_sumas]'> $d[kd_sumas] ($d[no_sumas]) </option>";
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Penerima</label>
                          <select name="penerima" id="" class="form-control">
                            <?php
                            while ($d = mysqli_fetch_array($pegawai)) {
                              if ($data['penerima'] == $d['no_peg']) {
                                $selected = 'selected';
                              } else {
                                $selected = '';
                              }
                              echo "<option $selected value='$d[no_peg]'> $d[nama_peg] ($d[no_peg]) </option>";
                            }
                            ?>
                          </select>
                        </div>

                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Catatan</label>
                          <textarea name="catatan" class="form-control" id=""><?= $data['catatan'] ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="d-flex justify-content-end">
                      <a href="disposisi.php" class="btn me-2 btn-secondary">Cancel</a>
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