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
  $nip = $_POST['nip'];
  $golongan = $_POST['golongan'];

  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES['photo']['name']);
  move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);

  $up = mysqli_query($konek, "INSERT INTO 
  pegawai(no_peg, nama_peg,nip, golongan, jabatan, alamat, no_telp, jns_kelamin, level, username, password, pertanyaan, photo)
  VALUES('$nopeg', '$nama','$nip','$golongan', '$jab', '$alamat', '$telp', '$kelamin', '$level', '$user', '$pass', '$lahir','$target_file')");
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
                  <div class="col-md-5">
                    <form action="" method="get">
                      <div class="d-flex flex-row-reverse bd-highlight">
                        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                        <select style="width: 15%;" name="limit" class="form-control me-2">
                          <option value="10" <?= isset($_GET['limit']) && $_GET['limit'] == 10 ? 'selected' : '' ?>>10</option>
                          <option value="25" <?= isset($_GET['limit']) && $_GET['limit'] == 25 ? 'selected' : '' ?>>25</option>
                          <option value="50" <?= isset($_GET['limit']) && $_GET['limit'] == 50 ? 'selected' : '' ?>>50</option>
                        </select>
                        <input type="text" class="form-control me-2" name="cari" placeholder="Cari data berdasarkan Nama Pegawai..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                      </div>
                    </form>
                  </div>
                  <div class="col-md-7">
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
                          <th>NIP</th>
                          <th>Golongan</th>
                          <th>Jabatan</th>
                          <th>No Telpon</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <?php
                      $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
                      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                      $cari = isset($_GET['cari']) ? $_GET['cari'] : '';

                      $queryCount = "SELECT COUNT(*) AS total FROM pegawai";
                      if (!empty($cari)) {
                        $queryCount .= " WHERE nama_peg LIKE '%$cari%'";
                      }
                      $result = mysqli_query($konek, $queryCount);
                      $totalData = mysqli_fetch_assoc($result)['total'];

                      $totalPages = ceil($totalData / $limit);
                      $offset = ($page - 1) * $limit;

                      $query = "SELECT * FROM pegawai";
                      if (!empty($cari)) {
                        $query .= " WHERE nama_peg LIKE '%$cari%'";
                      }
                      $query .= " LIMIT $offset, $limit";
                      $result = mysqli_query($konek, $query);

                      if (mysqli_num_rows($result) > 0) {
                        while ($t = mysqli_fetch_array($result)) {
                      ?>
                          <tbody>
                            <tr>
                              <td><?php echo $t['no_peg']; ?></td>
                              <td><?php echo $t['nama_peg']; ?></td>
                              <td><?php echo $t['nip']; ?></td>
                              <td><?php echo $t['golongan']; ?></td>
                              <td><?php echo $t['jabatan']; ?></td>
                              <td><?php echo $t['no_telp']; ?></td>
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
                      } else {
                        ?>
                        <tbody>
                          <tr>
                            <td colspan="7" align="center"> Data tidak ditemukan </td>
                          </tr>
                        </tbody>
                      <?php
                      }
                      ?>
                    </table>
                  </form>
                  <!-- Pagination -->
                  <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <!-- Tombol Previous -->
                      <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?cari=<?= $cari ?>&limit=<?= $limit ?>&page=<?= ($page > 1) ? $page - 1 : 1; ?>">Previous</a>
                      </li>

                      <!-- Nomor Halaman -->
                      <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                          <a class="page-link" href="?cari=<?= $cari ?>&limit=<?= $limit ?>&page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                      <?php endfor; ?>

                      <!-- Tombol Next -->
                      <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?cari=<?= $cari ?>&limit=<?= $limit ?>&page=<?= ($page < $totalPages) ? $page + 1 : $totalPages; ?>">Next</a>
                      </li>
                    </ul>
                  </nav>

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
              <input class="form-control mb-2" type="text" name="nopeg" value="<?php echo $newLa; ?>" readonly />
              <label>Foto :</label>
              <input class="form-control mb-2" type="file" name="photo" accept=".jpg,.jpeg,.png" name="foto" required />
              <label>Nama :</label>
              <input class="form-control mb-2" type="text" name="namapeg" autocomplete="off" placeholder="Masukan nama pegawai" />
              <label>NIP :</label>
              <input class="form-control mb-2" type="text" name="nip" autocomplete="off" placeholder="Masukan Nomor Induk Pegawai" />
              <label>Golongan :</label>
              <input class="form-control mb-2" type="text" name="golongan" autocomplete="off" placeholder="Masukan Golongan" />
              <label>Jabatan :</label>
              <input class="form-control mb-2" type="text" name="jabpeg" autocomplete="off" placeholder="Masukan jabatan pegawai" />
              <label>Alamat :</label>
              <input class="form-control mb-2" type="text" name="alamatpeg" autocomplete="off" placeholder="Masukan alamat pegawai" />
              <label>Telp :</label>
              <input class="form-control mb-2" type="number" name="telppeg" autocomplete="off" placeholder="Masukan no telp pegawai" />
              <label>Kelamin :</label>
              <select class="form-control mb-2" name="kelaminpeg">
                <option value="laki-laki"> Laki Laki </option>
                <option value="perempuan"> Perempuan </option>
              </select>
              <label>Level :</label>
              <select class="form-control mb-2" name="levelpeg">
                <option value="admin"> Admin </option>
                <option value="user"> User </option>
              </select>
              <label>Username :</label>
              <input class="form-control mb-2" type="text" name="userpeg" autocomplete="off" placeholder="Masukan username untuk pegawai" />
              <label>Password :</label>
              <input class="form-control mb-2" type="text" name="passpeg" autocomplete="off" placeholder="Masukan password untuk pegawai" />
              <label>Pertanyaan Kemanan :</label>
              <input class="form-control mb-2" type="text" name="lahir" autocomplete="off" placeholder="Dimana kamu lahir ?" />
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