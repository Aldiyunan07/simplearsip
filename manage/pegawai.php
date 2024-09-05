<?php
require_once '../assets/configuration/konek.php';
session_start();
if (empty($_SESSION['username'])) {
  header("Location: ../manage/index.php");
}
?>
<?php
if (isset($_POST['tambah'])) {
  $nopeg = $_POST['nopeg'];
  $nama = $_POST['namapeg'];
  $jab = $_POST['jabpeg'];
  $alamat = $_POST['alamatpeg'];
  $telp = $_POST['telppeg'];
  $kelamin = $_POST['kelaminpeg'];
  $level = $_POST['levelpeg'];
  $user = $_POST['userpeg'];
  $pass = $_POST['passpeg'];
  $lahir = $_POST['lahir'];

  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES['photo']['name']);
  move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);

  $up = mysqli_query($konek, "insert into pegawai(no_peg, nama_peg, jabatan, alamat, no_telp, jns_kelamin, level, username, password, pertanyaan, photo)values('$nopeg', '$nama', '$jab', '$alamat', '$telp', '$kelamin', '$level', '$user', '$pass', '$lahir','$target_file')");
  if ($up == TRUE) {
    echo "<script>alert('Tambah Data Pegawai Sukses!!')</script>";
    echo "<script>window.location.href='pegawai.php'</script>";
  } else {
    echo "<script>alert('Tambah Data Pegawai Gagal!!')</script>";
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
          <div class="col-lg-12 col-6">
            <div class="card box-primary">
              <div class="content p-4">
                <div class="box-header">
                  <h3 class="box-title">Data Pegawai</h3>
                </div><!-- /.box-header -->
                <div class="row">
                  <div class="col-md-4">
                    <form action="" method="get">
                      <input type="text" class="form-control" name="cari" placeholder="Cari data berdasarkan Nomor Pegawai...">
                    </form>
                  </div>
                  <div class="col-md-8">
                    <div class="d-flex flex-row-reverse bd-highlight">
                      <button data-toggle="modal" data-target="#MyPeg" class="btn btn-success"> Tambah Pegawai </button>
                      <a href="../tpl/print1.php" class="btn btn-secondary me-2"> Print </a>
                    </div>
                  </div>
                </div>
                <div class="box-body table-responsive">
                  <?php
                  if (isset($_GET['hapus'])) {
                    $idhps = $_GET['hapus'];
                    $queryhps = "delete from pegawai where no_peg='$idhps'";
                    $hps = $konek->query($queryhps);
                    if ($hps) {
                  ?>
                      <script>
                        alert('Sukses menghapus data')
                      </script>
                    <?php
                    } else {
                    ?>
                      <script>
                        alert('Gagal menghapus data')
                      </script>
                  <?php
                    }
                  }

                  ?>
                  <form action="" method="get">
                    <table id="pegawai" class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>No Pegawai</th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th>Alamat</th>
                          <th>Telp</th>
                          <th>Kelamin</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <?php
                      if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        $data = "select * from pegawai where no_peg like '%" . $cari . "%'";
                        $data1 = $konek->query($data);
                        $p = mysqli_fetch_array($data1);
                        if ($p == TRUE) {
                      ?>
                          <tbody>
                            <tr>
                              <td><?php echo $p['1']; ?></td>
                              <td><?php echo $p['2']; ?></td>
                              <td><?php echo $p['3']; ?></td>
                              <td><?php echo $p['4']; ?></td>
                              <td><?php echo $p['5']; ?></td>
                              <td><?php echo $p['6']; ?></td>
                              <td>
                                <a style="text-decoration: none;" class="text-primary" href="editpeg.php?details=<?php echo $t['1']; ?>">
                                  <i class="bi bi-pencil-square"></i>
                                </a>
                                <a style="text-decoration: none;" class="text-dark" href="../tpl/print.php?print=<?php echo $t['0']; ?>">
                                  <i class="bi bi-printer"></i>
                                </a>

                                <a style="text-decoration: none;" class="text-danger" href="?hapus=<?php echo $t['1']; ?>" onclick="return confirm('Yakin data akan dihapus ?');">
                                  <i class="bi bi-trash"></i>
                                </a>
                              </td>
                            </tr>
                          </tbody>
                        <?php
                        } else {
                        ?>
                          <tr>
                            <td align="center" colspan="7">Data tidak ditemukan.</td>
                          </tr>
                        <?php
                        }
                      } else {
                        $query = mysqli_query($konek, "select * from pegawai limit 10");
                        while ($t = mysqli_fetch_array($query)) {
                        ?>
                          <tbody>
                            <tr>
                              <td><?php echo $t['1']; ?></td>
                              <td><?php echo $t['2']; ?></td>
                              <td><?php echo $t['3']; ?></td>
                              <td><?php echo $t['4']; ?></td>
                              <td><?php echo $t['5']; ?></td>
                              <td><?php echo $t['6']; ?></td>
                              <td>
                                <a href="editpeg.php?id=<?= $t['0'] ?>" style="text-decoration: none;" class="text-primary">
                                  <i class="bi bi-pencil-square"></i>
                                </a>
                                <a style="text-decoration: none;" class="text-dark" href="../tpl/print.php?print=<?php echo $t['0']; ?>">
                                  <i class="bi bi-printer"></i>
                                </a>

                                <a style="text-decoration: none;" class="text-danger" href="?hapus=<?php echo $t['1']; ?>" onclick="return confirm('Yakin data akan dihapus ?');">
                                  <i class="bi bi-trash"></i>
                                </a>
                              </td>
                            </tr>
                          </tbody>
                      <?php
                        }
                      }
                      ?>
                    </table>
                  </form>
                </div><!-- /.box-body -->
              </div>
            </div><!-- /.box -->
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- tampilan popup Tambah Pegawai -->
  <div id="myPeg" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <center>
            <font><b>Masukan Data Pegawai</b></font>
          </center>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data">
            <?php
            //kode otomatis
            $que1 = $konek->query("select max(no_peg) as maxNo from pegawai");
            $data1  = mysqli_fetch_array($que1);
            $noSur1 = $data1['maxNo'];

            $noUrut1 = (int) substr($noSur1, 3, 3);
            $noUrut1++;

            $isi = "PEG";
            $newLa = $isi . sprintf("%03s", $noUrut1);
            ?>
            <div class="form-group">
              <label>No Pegawai :</label>
              <input class="form-control" type="text" name="nopeg" value="<?php echo $newLa; ?>" readonly />
              <label>Foto :</label>
              <input class="form-control" type="file" name="photo" accept=".jpg,.jpeg,.png" name="foto" required />
              <label>Nama :</label>
              <input class="form-control" type="text" name="namapeg" placeholder="masukan nama pegawai" />
              <label>Jabatan :</label>
              <input class="form-control" type="text" name="jabpeg" placeholder="masukan jabatan pegawai" />
              <label>Alamat :</label>
              <input class="form-control" type="text" name="alamatpeg" placeholder="masukan alamat pegawai" />
              <label>Telp :</label>
              <input class="form-control" type="number" name="telppeg" placeholder="masukan no telp pegawai" />
              <label>Kelamin :</label>
              <select class="form-control" name="kelaminpeg">
                <option class="form-control">
                  laki-laki
                </option>
                <option class="form-control">
                  perempuan
                </option>
                <select>
                  <label>Level :</label>
                  <select class="form-control" name="levelpeg">
                    <option class="form-control">
                      admin
                    </option>
                    <option class="form-control">
                      user
                    </option>
                    <select>
                      <label>Username :</label>
                      <input class="form-control" type="text" name="userpeg" placeholder="masukan username untuk pegawai" />
                      <label>Password :</label>
                      <input class="form-control" type="text" name="passpeg" placeholder="masukan password untuk pegawai" />
                      <label>Pertanyaan Kemanan :</label>
                      <input class="form-control" type="text" name="lahir" placeholder="dimana kamu lahir ?" />
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button class="btn btn-primary" name="tambah">Tambah Pegawai</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php require_once('../tpl/sumas.php'); ?>
<?php require_once('../tpl/sukel.php'); ?>
<?php require_once('../tpl/dispo.php'); ?>
<?php require_once('../tpl/about.php'); ?>
<?php require_once('../tpl/footer.php'); ?>