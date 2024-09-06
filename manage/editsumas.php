<?php
session_start();
if (empty($_SESSION['username'])) {
  header("Location: ../index.php");
}
include '../assets/configuration/konek.php';
if (isset($_GET['id'])) {
  $kd_sumas = $_GET['id'];
  $sumas = mysqli_query($konek, "SELECT * FROM surat_masuk WHERE kd_sumas='$kd_sumas' LIMIT 1");
  $data = mysqli_fetch_assoc($sumas);
  $pegawai = mysqli_query($konek, "SELECT * FROM pegawai");
}

if (isset($_POST['update'])) {
  $kd_sumas = $_POST['kd_sumas'];
  $no_sumas = $_POST['no_sumas'];
  $tgl_sumas = $_POST['tgl_sumas'];
  $tgl_sumasdtg = $_POST['tgl_sumasdtg'];
  $jns_sumas = $_POST['jns_sumas'];
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $instansi = $_POST['instansi'];
  $penerima = $_POST['penerima'];
  $update = mysqli_query($konek, "UPDATE surat_masuk SET
    no_sumas = '$no_sumas',
    tgl_sumas = '$tgl_sumas',
    tgl_sumasdtg = '$tgl_sumasdtg',
    jns_sumas = '$jns_sumas',
    judul = '$judul',
    isi = '$isi',
    instansi = '$instansi',
    penerima = '$penerima'
    WHERE kd_sumas = '$kd_sumas'
  ");
  if ($update) {
    echo "<script> alert('Berhasil mengupdate surat masuk!!');</script>";
    echo "<script>window.location.href='surat-masuk.php'</script>";
  }else{
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
                  <h4>Edit Surat Masuk</h4>
                </div>
                <form action="" enctype="multipart/form-data" method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Kode Surat</label>
                          <input name="kd_sumas" type="text" class="form-control" value="<?= $data['kd_sumas'] ?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="">Nama Instansi / Pengirim</label>
                          <input name="instansi" type="text" class="form-control" value="<?= $data['instansi'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Tanggal Surat</label>
                          <input name="tgl_sumas" type="date" id="tanggal" class="form-control" value="<?= $data['tgl_sumas'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Jenis Surat</label>
                          <input name="jns_sumas" type="text" class="form-control" value="<?= $data['jns_sumas'] ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">No Surat</label>
                          <input name="no_sumas" type="text" class="form-control" value="<?= $data['no_sumas'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Ditujukan Kepada</label>
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
                        <div class="form-group">
                          <label for="">Tanggal Di Terima</label>
                          <input name="tgl_sumasdtg" type="date" id="tanggal" class="form-control" value="<?= $data['tgl_sumasdtg'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Subject</label>
                          <input name="judul" type="text" class="form-control" value="<?= $data['judul'] ?>">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Isi Surat</label>
                          <textarea name="isi" class="form-control" id=""><?= $data['isi'] ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="d-flex justify-content-end">
                      <a href="surat-masuk.php" class="btn me-2 btn-secondary">Cancel</a>
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