<?php
session_start();
if (empty($_SESSION['username'])) {
  header("Location: ../index.php");
}

include '../assets/configuration/konek.php';

if (isset($_GET['id'])) {
  $no_peg = $_GET['id'];
  $tampil = $konek->query("SELECT * FROM pegawai WHERE id='$no_peg'");
  $tam = mysqli_fetch_array($tampil);
}

if (isset($_POST['edit'])) {
  $user1 = $_POST['nopeg'];
  $namapeg1 = $_POST['namapeg'];
  $jabpeg1 = $_POST['jabpeg'];
  $alamatpeg1 = $_POST['alamatpeg'];
  $telppeg1 = $_POST['telppeg'];
  $kelaminpeg1 = $_POST['kelaminpeg'];
  $levelpeg1 = $_POST['levelpeg'];


  $pegawai = mysqli_query($konek, "SELECT * FROM pegawai WHERE no_peg='$user1' LIMIT 1");
  $check = mysqli_fetch_array($pegawai);
  if (!empty($_FILES['photopeg']['name'])) {
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES['photopeg']['name']);

    if (!empty($check['photo']) && file_exists($check['photo'])) {
      unlink($check['photo']);
    }

    if (move_uploaded_file($_FILES['photopeg']['tmp_name'], $target_file)) {
      $updateImage = mysqli_query($konek, "UPDATE pegawai SET photo='$target_file' WHERE no_peg='$user1'");
    } else {
      echo "<script>alert('Gagal mengupload file!')</script>";
    }
  }

  // Update data di database
  $perintah3 = mysqli_query($konek, "UPDATE pegawai SET 
      nama_peg='$namapeg1', 
      jabatan='$jabpeg1', 
      alamat='$alamatpeg1', 
      no_telp='$telppeg1', 
      jns_kelamin='$kelaminpeg1', 
      level='$levelpeg1'
      WHERE no_peg='$user1'");

  if ($perintah3) {
    echo "<script>alert('Berhasil mengupdate data!')</script>";
    echo "<script>window.location.href='pegawai.php'</script>";
  } else {
    echo "<script>alert('Gagal mengupdate data!')</script>";
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
                  <h4>Edit Pegawai</h4>
                </div>
                <form method="post" enctype="multipart/form-data" action="">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="hidden" name="nopeg" value="<?= $tam['no_peg'] ?>">
                          <label for="">Photo</label>
                          <input class="form-control" type="file" name="photopeg" id="" value="<?= $tam['nama_peg'] ?>">
                        </div>
                      </div>
                      <div class="col-md-6"></div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="hidden" name="nopeg" value="<?= $tam['no_peg'] ?>">
                          <label for="">Nama Pegawai</label>
                          <input class="form-control" type="text" name="namapeg" id="" value="<?= $tam['nama_peg'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Alamat</label>
                          <input class="form-control" type="text" name="alamatpeg" id="" value="<?= $tam['alamat'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Jenis Kelamin</label>
                          <select class="form-control" name="kelaminpeg" id="">
                            <option value="laki-laki" <?= ($tam['jns_kelamin'] == 'laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="perempuan" <?= ($tam['jns_kelamin'] == 'perempuan') ? 'selected' : '' ?>>Perempuan</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Jabatan</label>
                          <input class="form-control" type="text" name="jabpeg" id="" value="<?= $tam['jabatan'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">No Telpon</label>
                          <input class="form-control" type="text" name="telppeg" id="" value="<?= $tam['no_telp'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Level</label>
                          <select class="form-control" name="levelpeg" id="">
                            <option value="admin" <?= ($tam['level'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= ($tam['level'] == 'user') ? 'selected' : '' ?>>User</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer" style="background-color: white;">
                    <div class="d-flex flex-row-reverse bd-highlight">
                      <button name="edit" class="btn btn-success">Update</button>
                      <a href="pegawai.php" class="btn btn-secondary mr-2">Cancel</a>
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

<?php require_once('../tpl/footer.php'); ?>