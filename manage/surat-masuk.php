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
          <div class="col-lg-12 col-6">
            <div class="card box-primary">
              <div class="content p-4">
                <div class="box-header">
                  <h3 class="box-title">Data Surat Masuk</h3>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <form action="" method="get">
                      <input type="text" class="form-control" name="cari" placeholder="Cari data berdasarkan Kode Sumas...">
                    </form>
                  </div>
                  <div class="col-md-8">
                    <div class="d-flex flex-row-reverse bd-highlight">
                      <?php
                      if ($_SESSION['level'] == 'admin') {
                        echo "<button data-toggle='modal' data-target='#MyMod' class='btn btn-success'> Tambah Surat Masuk </button>";
                      }
                      ?>
                      <a href="../tpl/print1.php" class="btn btn-secondary me-2"> Print </a>
                    </div>
                  </div>
                </div>
                <div class="box-body table-responsive">
                  <?php
                  // Hapus data jika ada
                  if (isset($_GET['hapussumas'])) {
                    $idhps = $_GET['hapussumas'];
                    $queryhps = "DELETE FROM surat_masuk WHERE kd_sumas='$idhps'";
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

                  <?php
                  $jumlahDataPerHalaman = 10;

                  $result = mysqli_query($konek, "SELECT COUNT(*) AS total FROM surat_masuk");
                  $totalData = mysqli_fetch_assoc($result)['total'];
                  $totalHalaman = ceil($totalData / $jumlahDataPerHalaman);
                  $halamanAktif = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                  $awalData = ($halamanAktif - 1) * $jumlahDataPerHalaman;
                  if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $query = mysqli_query($konek, "SELECT * FROM surat_masuk WHERE kd_sumas LIKE '%$cari%' LIMIT $awalData, $jumlahDataPerHalaman");
                  } else {
                    $query = mysqli_query($konek, "SELECT * FROM surat_masuk LIMIT $awalData, $jumlahDataPerHalaman");
                  }
                  ?>

                  <form action="" method="get">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Surat</th>
                          <th>No Surat</th>
                          <th>Tgl Surat</th>
                          <th>Tgl Surat Datang</th>
                          <th>Judul Surat</th>
                          <th>Isi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (mysqli_num_rows($query) > 0) {
                          while ($t = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                              <td><?= $t['kd_sumas']; ?></td>
                              <td><?= $t['no_sumas']; ?></td>
                              <td><?= $t['tgl_sumas']; ?></td>
                              <td><?= $t['tgl_sumasdtg']; ?></td>
                              <td><?= $t['judul']; ?></td>
                              <td><?= $t['isi']; ?></td>
                              <td align="center">
                                <a href="detailsumas.php?details=<?= $t['kd_sumas'] ?>" style="text-decoration: none;" class="text-success">
                                  <i class="bi bi-info"></i>
                                </a>
                                <?php
                                if ($_SESSION['level'] == 'admin') {
                                ?>
                                  <a style="text-decoration: none;" class="text-primary" href="editsumas.php?id=<?php echo $t['kd_sumas']; ?>">
                                    <i class="bi bi-pencil-square"></i>
                                  </a>
                                  <a style="text-decoration: none;" class="text-danger" href="?hapussumas=<?php echo $t['kd_sumas']; ?>" onclick="return confirm('Yakin data akan dihapus ?');">
                                    <i class="bi bi-trash"></i>
                                  </a>
                                <?php
                                }
                                ?>
                              </td>
                            </tr>
                          <?php
                          }
                        } else {
                          ?>
                          <tr>
                            <td align="center" colspan="7">Data tidak ditemukan.</td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </form>

                  <!-- Pagination -->
                  <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <!-- Tombol Previous -->
                      <li class="page-item <?= ($halamanAktif <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= ($halamanAktif > 1) ? $halamanAktif - 1 : 1; ?>">Previous</a>
                      </li>

                      <!-- Nomor Halaman -->
                      <?php for ($i = 1; $i <= $totalHalaman; $i++) : ?>
                        <li class="page-item <?= ($i == $halamanAktif) ? 'active' : ''; ?>">
                          <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                      <?php endfor; ?>

                      <!-- Tombol Next -->
                      <li class="page-item <?= ($halamanAktif >= $totalHalaman) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= ($halamanAktif < $totalHalaman) ? $halamanAktif + 1 : $totalHalaman; ?>">Next</a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<!-- tampilan popup kirim surat -->
<div id="myMod" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <font><b>Masukan Data Surat Masuk</b></font>
        </center>
      </div>
      <div class="modal-body">
        <form method="POST" action="" enctype="multipart/form-data">
          <?php
          //kode otomatis
          $que5 = $konek->query("select max(kd_sumas) as maxKd from surat_masuk");
          $data5  = mysqli_fetch_array($que5);
          $noSur5 = $data5['maxKd'];

          $noUrut5 = (int) substr($noSur5, 6, 6);
          $noUrut5++;

          $char5 = "SUMAS";
          $newKD = $char5 . sprintf("%03s", $noUrut5);
          ?>
          <div class="form-group">
            <label>Kode Surat :</label>
            <input class="form-control" type="text" name="kdsur" value="<?php echo $newKD; ?>" readonly />
            <label>No Surat :</label>
            <input class="form-control" type="text" name="nosur" value="" />
            <label>Nama Instansi/pengirim :</label>
            <input class="form-control" type="text" name="instansi" placeholder="masukan nama pengirim/lembaga" />
            <label>Ditujukan kepada :</label>
            <select class="form-control" name="penerima">
              <?php
              $peg = mysqli_query($konek, "select * from pegawai");
              while ($peg1 = mysqli_fetch_array($peg)) {

              ?>
                <option><?php echo $peg1['no_peg']; ?> (<?= $peg1['nama_peg']; ?>) </option>
              <?php
              }
              ?>
            </select>
            <label>Tanggal Surat :</label>
            <input class="form-control" type="text" id="tanggal" name="tglsur" placeholder="tanggal pada surat" />
            <label>Tanggal Diterima :</label>
            <input class="form-control" type="text" id="tanggal3" name="tglsurdtg" placeholder="tanggal surat  diterima" />
            <label>Jenis Surat:</label>
            <input class="form-control" type="text" name="jnssur" value="" />
            <label>Subject :</label>
            <input class="form-control" type="text" name="judul" placeholder="masukan subject" />
            <label>Keterangan :</label>
            <textarea class="form-control" type="text" name="isi" placeholder="masukan keterangan surat ( jika ada )"></textarea>
            <label>Pilih File :</label>
            <input type="file" name="filesumas" />
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary" name="sumas">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_POST['sumas'])) {
  $kd_sumas = $_POST['kdsur'];
  $no_sumas = $_POST['nosur'];
  $tgl_sumas = $_POST['tglsur'];
  $jenis_sumas = $_POST['jnssur'];
  $judul_sumas = $_POST['judul'];
  $isi_sumas = $_POST['isi'];
  $ins_sumas = $_POST['instansi'];
  $tgldtg_sumas = $_POST['tglsurdtg'];
  $penerima_sumas = $_POST['penerima'];

  //untuk file
  $extensi_file_sumas = array('png', 'jpg', 'pdf', 'xlsx', 'jpeg');
  $nama_sumas = $_FILES['filesumas']['name'];
  $x9 = explode('.', $nama_sumas);
  $extensisumas = strtolower(end($x9));
  $ukuran9 = $_FILES['filesumas']['size'];
  $lokasi_sumas = $_FILES['filesumas']['tmp_name'];

  if (in_array($extensisumas, $extensi_file_sumas) == true) {
    if ($ukuran9 < 1044070) {
      move_uploaded_file($lokasi_sumas, 'upload_sumas/' . $nama_sumas);
      $kirim = "insert into surat_masuk(kd_sumas, no_sumas, tgl_sumas, tgl_sumasdtg, jns_sumas, judul, isi, instansi, penerima, file_sumas)values('$kd_sumas', '$no_sumas', '$tgl_sumas', '$tgldtg_sumas', '$jenis_sumas', '$judul_sumas', '$isi_sumas', '$ins_sumas', '$penerima_sumas', '$nama_sumas')";
      $kirim1 = $konek->query($kirim);

      if ($kirim1) {
        echo "<script>alert('surat masuk berhasil di tambah!!')</script>";
        echo "<script>window.location.href='surat-masuk.php';</script>";
      } else {
        echo "<script>alert('surat masuk gagal ditambah!!')</script>";
      }
    } else {
      echo "<script>alert('Ukuran file terlalu besar!')</script>";
    }
  } else {
    echo "<script>alert('type file tidak diperbolehkan!')</script>";
  }
}


?>
<?php require_once('../tpl/about.php'); ?>
<?php require_once('../tpl/footer.php'); ?>