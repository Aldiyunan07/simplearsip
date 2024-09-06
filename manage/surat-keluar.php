<?php
require_once '../assets/configuration/konek.php';
session_start();
if (empty($_SESSION['username'])) {
  header("Location: ../manage/index.php");
}

// Set jumlah data per halaman
$limit = 10;

// Dapatkan halaman saat ini dari URL, jika tidak ada, default ke halaman 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data di tabel surat_keluar
$totalQuery = mysqli_query($konek, "SELECT COUNT(*) as total FROM surat_keluar");
$totalData = mysqli_fetch_assoc($totalQuery)['total'];
$totalPages = ceil($totalData / $limit);
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
                  <h3 class="box-title">Data Surat Keluar</h3>
                </div><!-- /.box-header -->
                <div class="row">
                  <div class="col-md-4">
                    <form action="" method="get">
                      <input type="text" class="form-control" name="cari" placeholder="Cari data berdasarkan Kode Sukel...">
                    </form>
                  </div>
                  <div class="col-md-8">
                    <div class="d-flex flex-row-reverse bd-highlight">
                      <?php
                      if ($_SESSION['level'] == 'admin') {
                        echo "<button data-toggle='modal' data-target='#MyLose' class='btn btn-success'> Tambah Surat Keluar </button>";
                      }
                      ?>
                      <a href="../tpl/print1.php" class="btn btn-secondary me-2"> Print </a>
                    </div>
                  </div>
                </div>
                <div class="box-body table-responsive">
                  <?php
                  // Hapus data jika ada permintaan hapus
                  if (isset($_GET['hapussukel'])) {
                    $idhps = $_GET['hapussukel'];
                    $queryhps = "DELETE FROM surat_keluar WHERE kd_sukel='$idhps'";
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
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Surat</th>
                          <th>No Surat</th>
                          <th>Tgl Surat</th>
                          <th>Instansi</th>
                          <th>Judul Surat</th>
                          <th>Isi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (isset($_GET['cari'])) {
                          $cari = $_GET['cari'];
                          $data = "SELECT * FROM surat_keluar WHERE kd_sukel LIKE '%" . $cari . "%' LIMIT $limit OFFSET $offset";
                          $data1 = $konek->query($data);
                          while ($p = mysqli_fetch_array($data1)) {
                        ?>
                            <tr>
                              <td><?php echo $p['1']; ?></td>
                              <td><?php echo $p['2']; ?></td>
                              <td><?php echo $p['3']; ?></td>
                              <td><?php echo $p['4']; ?></td>
                              <td><?php echo $p['5']; ?></td>
                              <td><?php echo $p['6']; ?></td>
                              <td align="center">
                                <a href="detailsukel.php?details=<?= $p['1'] ?>" class="text-success">
                                  <i class="bi bi-info"></i>
                                </a>
                                <?php if ($_SESSION['level'] == 'admin') { ?>
                                  <a href="editsukel.php?id=<?= $p['1'] ?>" class="text-dark">
                                    <i class="bi bi-pencil-square"></i>
                                  </a>
                                  <a href="?hapussukel=<?= $p['1'] ?>" class="text-danger" onclick="return confirm('Yakin data akan dihapus ?');">
                                    <i class="bi bi-trash"></i>
                                  </a>
                                <?php } ?>
                              </td>
                            </tr>
                          <?php
                          }
                        } else {
                          $query = mysqli_query($konek, "SELECT * FROM surat_keluar LIMIT $limit OFFSET $offset");
                          while ($t = mysqli_fetch_array($query)) {
                          ?>
                            <tr>
                              <td><?php echo $t['1']; ?></td>
                              <td><?php echo $t['2']; ?></td>
                              <td><?php echo $t['3']; ?></td>
                              <td><?php echo $t['4']; ?></td>
                              <td><?php echo $t['5']; ?></td>
                              <td><?php echo $t['6']; ?></td>
                              <td align="center">
                                <a href="detailsukel.php?details=<?= $t['1'] ?>" class="text-success" style="text-decoration: none;">
                                  <i class="bi bi-info"></i>
                                </a>
                                <?php if ($_SESSION['level'] == 'admin') { ?>
                                  <a href="editsukel.php?id=<?= $t['1'] ?>" class="text-primary" style="text-decoration: none;">
                                    <i class="bi bi-pencil-square"></i>
                                  </a>
                                  <a href="?hapussukel=<?= $t['1'] ?>" class="text-danger" onclick="return confirm('Yakin data akan dihapus ?');">
                                    <i class="bi bi-trash"></i>
                                  </a>
                                <?php } ?>
                              </td>
                            </tr>
                        <?php
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </form>
                  <!-- Pagination -->
                  <!-- Pagination -->

                  <!-- Pagination -->
                  <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <!-- Tombol Previous -->
                      <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= ($page > 1) ? $page - 1 : 1; ?>">Previous</a>
                      </li>

                      <!-- Nomor Halaman -->
                      <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                          <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                      <?php endfor; ?>

                      <!-- Tombol Next -->
                      <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= ($page < $totalPages) ? $page + 1 : $totalPages; ?>">Next</a>
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
<div id="myLose" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <font><b>Masukan Data Surat Keluar</b></font>
        </center>
      </div>
      <div class="modal-body">
        <form method="POST" action="" enctype="multipart/form-data">
          <?php
          //kode otomatis
          $que6 = $konek->query("select max(kd_sukel) as maxKd from surat_keluar");
          $data6  = mysqli_fetch_array($que6);
          $noSur6 = $data6['maxKd'];

          $noUrut6 = (int) substr($noSur6, 6, 6);
          $noUrut6++;

          $char6 = "SUKEL";
          $newKD3 = $char6 . sprintf("%03s", $noUrut6);
          ?>
          <div class="form-group">
            <label>Kode Surat :</label>
            <input class="form-control" type="text" name="kdsukel" value="<?php echo $newKD3 ?>" readonly />
            <label>No Surat :</label>
            <input class="form-control" type="text" name="nosukel" value="" />
            <label>Nama Instansi :</label>
            <input class="form-control" type="text" name="instansisukel" placeholder="masukan nama pengirim/lembaga yang dituju" />
            <label>Tanggal Surat :</label>
            <input class="form-control" type="text" id="tanggal4" name="tglsukel" placeholder="tanggal pada surat" />
            <label>Subject :</label>
            <input class="form-control" type="text" name="judulsukel" placeholder="masukan subject" />
            <label>Keterangan :</label>
            <textarea class="form-control" type="text" name="isisukel" placeholder="masukan keterangan surat ( jika ada )"></textarea>
            <label>Pilih File :</label>
            <input type="file" name="filesukel" />
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary" name="sukel">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_POST['sukel'])) {
  $kd_sukel = $_POST['kdsukel'];
  $no_sukel = $_POST['nosukel'];
  $ins_sukel = $_POST['instansisukel'];
  $tgl_sukel = $_POST['tglsukel'];
  $judul_sukel = $_POST['judulsukel'];
  $isi_sukel = $_POST['isisukel'];

  //untuk file
  $extensi_file_sukel = array('png', 'jpg', 'pdf', 'xlsx');
  $nama_sukel = $_FILES['filesukel']['name'];
  $x3 = explode('.', $nama_sukel);
  $extensisukel = strtolower(end($x3));
  $ukuran_sukel = $_FILES['filesukel']['size'];
  $lokasi_sukel = $_FILES['filesukel']['tmp_name'];

  if (in_array($extensisukel, $extensi_file_sukel) == true) {
    if ($ukuran_sukel < 1044070) {
      move_uploaded_file($lokasi_sukel, 'upload_sukel/' . $nama_sukel);
      $kirim_sukel = "insert into surat_keluar(kd_sukel, no_sukel, tgl_sukel, instansi, judul_sukel, isi_sukel, file_sukel)values('$kd_sukel', '$no_sukel', '$tgl_sukel', '$ins_sukel', '$judul_sukel', '$isi_sukel', '$nama_sukel')";
      $kirim_sukel1 = $konek->query($kirim_sukel);

      if ($kirim_sukel1) {
        echo "<script>alert('surat keluar berhasil di tambah!!')</script>";
        echo "<script>window.location.href='surat-keluar.php';</script>";
      } else {
        echo "<script>alert('surat keluar gagal ditambah!!')</script>";
      }
    } else {
      echo "<script>alert('Ukuran file terlalu besar!')</script>";
    }
  }
}

?>
<?php require_once('../tpl/about.php'); ?>
<?php require_once('../tpl/footer.php'); ?>