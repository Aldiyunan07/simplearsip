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
                  <div class="col-md-5">
                    <form action="" method="get">
                      <div class="d-flex flex-row-reverse bd-highlight">
                        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                        <select style="width: 15%;" name="limit" class="form-control me-2">
                          <option value="10" <?= isset($_GET['limit']) && $_GET['limit'] == 10 ? 'selected' : '' ?>>10</option>
                          <option value="25" <?= isset($_GET['limit']) && $_GET['limit'] == 25 ? 'selected' : '' ?>>25</option>
                          <option value="50" <?= isset($_GET['limit']) && $_GET['limit'] == 50 ? 'selected' : '' ?>>50</option>
                        </select>
                        <input type="text" class="form-control me-2" name="cari" placeholder="Cari data berdasarkan Instansi..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                      </div>
                    </form>
                  </div>
                  <div class="col-md-7">
                    <div class="d-flex flex-row-reverse bd-highlight">
                      <?php
                      if ($_SESSION['level'] == 'admin') {
                        echo "<button data-toggle='modal' data-target='#MyMod' class='btn btn-success'> Tambah Surat Masuk </button>";
                      }
                      ?>
                      <a href="fpdf/pdf_export.php?query=sumas" class="btn btn-secondary me-2"> Print </a>
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
                  $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
                  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                  $cari = isset($_GET['cari']) ? $_GET['cari'] : '';

                  $queryCount = "SELECT COUNT(*) AS total FROM surat_masuk";
                  if (!empty($cari)) {
                    $queryCount .= " WHERE instansi LIKE '%$cari%'";
                  }
                  $result = mysqli_query($konek, $queryCount);
                  $totalData = mysqli_fetch_assoc($result)['total'];

                  $totalPages = ceil($totalData / $limit);
                  $offset = ($page - 1) * $limit;

                  $query = "SELECT * FROM surat_masuk";
                  if (!empty($cari)) {
                    $query .= " WHERE instansi LIKE '%$cari%'";
                  }
                  $query .= " LIMIT $offset, $limit";
                  $result = mysqli_query($konek, $query);
                  ?>

                  <form action="" method="get">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="text-align: center;">Kode Surat</th>
                          <th style="text-align: center;">No Surat</th>
                          <th style="text-align: center;">Tgl Surat Datang</th>
                          <th style="text-align: center;">Instansi</th>
                          <th style="text-align: center;">Judul Surat</th>
                          <th style="text-align: center;">Isi</th>
                          <th style="text-align: center;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                          while ($t = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                              <td><?= $t['kd_sumas']; ?></td>
                              <td><?= $t['no_sumas']; ?></td>
                              <td><?= $t['tgl_sumasdtg']; ?></td>
                              <td><?= $t['instansi']; ?></td>
                              <td><?= $t['judul']; ?></td>
                              <td><?= $t['isi']; ?></td>
                              <td style="text-align: center;">
                                <a href="detailsumas.php?details=<?= $t['kd_sumas'] ?>" style="text-decoration: none;" class="text-success">
                                  <i class="bi bi-info"></i>
                                </a>
                                <?php
                                if ($_SESSION['level'] == 'admin') {
                                ?>
                                  <a style="text-decoration: none;" class="text-primary" href="editsumas.php?id=<?= $t['kd_sumas']; ?>">
                                    <i class="bi bi-pencil-square"></i>
                                  </a>
                                  <a style="text-decoration: none;" class="text-danger" href="?hapussumas=<?= $t['kd_sumas']; ?>" onclick="return confirm('Yakin data akan dihapus ?');">
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
                            <td style="text-align: center;" colspan="7">Data tidak ditemukan.</td>
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
          if (isset($data5['maxKd'])) {
            $noSur5 = $data5['maxKd'];
          } else {
            $noSur5 = 0;
          }

          $noUrut5 = (int) substr($noSur5, 6, 6);
          $noUrut5++;

          $char5 = "SUMAS";
          $newKD = $char5 . sprintf("%03s", $noUrut5);
          ?>
          <div class="form-group">
            <label>Kode Surat :</label>
            <input class="form-control mb-2" type="text" name="kdsur" value="<?php echo $newKD; ?>" readonly />
            <label>No Surat :</label>
            <input class="form-control mb-2" type="text" name="nosur" value="" autocomplete="off" />
            <label>Nama Instansi/pengirim :</label>
            <input class="form-control mb-2" type="text" name="instansi" placeholder="Masukan nama pengirim/lembaga" autocomplete="off" />
            <label>Ditujukan kepada :</label>
            <select class="form-control mb-2" name="penerima">
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
            <input class="form-control mb-2" type="text" id="tanggal" name="tglsur" placeholder="Tanggal pada surat" autocomplete="off" />
            <label>Tanggal Diterima :</label>
            <input class="form-control mb-2" type="text" id="tanggal3" name="tglsurdtg" placeholder="Tanggal surat  diterima" autocomplete="off" />
            <label>Jenis Surat:</label>
            <input class="form-control mb-2" type="text" name="jnssur" value="" placeholder="Jenis Surat" autocomplete="off" />
            <label>Subject :</label>
            <input class="form-control mb-2" type="text" name="judul" placeholder="Masukan subject" autocomplete="off" />
            <label>Keterangan :</label>
            <textarea class="form-control mb-2" type="text" name="isi" placeholder="Masukan keterangan surat ( jika ada )"></textarea>
            <label>Pilih File :</label>
            <input type="file" class="form-control" name="filesumas" />
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