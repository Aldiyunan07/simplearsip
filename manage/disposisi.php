<?php
require_once '../assets/configuration/konek.php';
session_start();
if (empty($_SESSION['username'])) {
  header("Location: ../manage/index.php");
}

$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
$offset = ($page - 1) * $limit; // Menghitung data mulai dari index ke berapa
?>
<div class="app-wrapper">
  <?php require_once('../tpl/header.php'); ?>
  <?php require_once('../tpl/sidebar.php'); ?>
  <main class="app-main">
    <div class="app-content">
      <div class="container-fluid">
        <div class="row mt-3">
          <div class="col-lg col-6">
            <div class="card box-primary">
              <div class="content p-4">
                <div class="box-header">
                  <h3 class="box-title"> Disposisi Surat </h3>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <form action="" method="get">
                      <input type="text" class="form-control" name="cari" placeholder="Cari data berdasarkan No Disposisi...">
                    </form>
                  </div>
                  <div class="col-md-8">
                    <div class="d-flex flex-row-reverse bd-highlight">
                      <?php
                      if ($_SESSION['level'] == 'admin') {
                        echo "<button data-toggle='modal' data-target='#myDispo' class='btn btn-success'> Tambah Disposisi </button>";
                      }
                      ?>
                      <a href="../tpl/printdispoall.php" class="btn btn-secondary me-2"> Print </a>
                    </div>
                  </div>
                </div>
                <div class="box-body table-responsive">
                  <?php
                  if (isset($_GET['hapusdispo'])) {
                    $idhps1 = $_GET['hapusdispo'];
                    $queryhps = "DELETE FROM disposisi WHERE no_disposisi='$idhps1'";
                    $hps = $konek->query($queryhps);
                    if ($hps) {
                  ?>
                      <script>
                        alert('Sukses menghapus data');
                        window.location.href = 'disposisi.php';
                      </script>
                    <?php
                    } else {
                    ?>
                      <script>
                        alert('Gagal menghapus data');
                      </script>
                  <?php
                    }
                  }

                  ?>
                  <form action="" method="get">
                    <table id="pegawai" class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>No Disposisi</th>
                          <th>No Sumas</th>
                          <th>Tgl Disposisi</th>
                          <th>Penerima</th>
                          <th>Judul Dispo</th>
                          <th>Catatan/Deskripsi</th>
                          <th>Pengirim</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <?php
                      // Untuk pencarian data
                      if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        $data = "SELECT * FROM disposisi WHERE no_disposisi LIKE '%" . $cari . "%' LIMIT $limit OFFSET $offset";
                        $data1 = $konek->query($data);
                        if (mysqli_num_rows($data1) > 0) {
                          while ($p = mysqli_fetch_array($data1)) {
                      ?>
                            <tbody>
                              <tr>
                                <td><?= $p['1']; ?></td>
                                <td><?= $p['2']; ?></td>
                                <td><?= $p['3']; ?></td>
                                <td><?= $p['4']; ?></td>
                                <td><?= $p['5']; ?></td>
                                <td><?= $p['6']; ?></td>
                                <td><?= $p['7']; ?></td>
                                <td align="center">
                                  <a href="detaildispo.php?detaildispo=<?php echo $p['2']; ?>" class="text-success" style="text-decoration: none;">
                                    <i class="bi bi-file-earmark-fill"></i>
                                  </a>
                                  <?php
                                  if ($_SESSION['level'] == 'admin') {
                                  ?>
                                    <a href="editdisposisi.php?id=<?php echo $p['0']; ?>" class="text-dark" style="text-decoration: none;">
                                      <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="?hapusdispo=<?php echo $p['1']; ?>" class="text-danger" style="text-decoration: none;" onclick="return confirm('Yakin data akan dihapus?');">
                                      <i class="bi bi-trash"></i>
                                    </a>
                                  <?php
                                  }
                                  ?>
                                </td>
                              </tr>
                            </tbody>
                          <?php
                          }
                        } else {
                          ?>
                          <tr>
                            <td colspan="8" align="center">Data tidak ditemukan.</td>
                          </tr>
                        <?php
                        }
                      } else {
                        // Menampilkan semua data
                        $query = mysqli_query($konek, "SELECT * FROM disposisi LIMIT $limit OFFSET $offset");
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
                              <td><?php echo $t['7']; ?></td>
                              <td align="center">
                                <a href="detaildispo.php?detaildispo=<?php echo $t['2']; ?>" class="text-success" style="text-decoration: none;">
                                  <i class="bi bi-file-earmark-fill"></i>
                                </a>
                                  <?php
                                  if ($_SESSION['level'] == 'admin') {
                                  ?>
                                    <a href="editdisposisi.php?id=<?php echo $t['1']; ?>" class="text-primary" style="text-decoration: none;">
                                      <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="?hapusdispo=<?php echo $t['1']; ?>" class="text-danger" style="text-decoration: none;" onclick="return confirm('Yakin data akan dihapus?');">
                                      <i class="bi bi-trash"></i>
                                    </a>
                                  <?php
                                  }
                                  ?>
                              </td>
                            </tr>
                          </tbody>
                      <?php
                        }
                      }
                      ?>
                    </table>
                  </form>

                  <?php
                  // Hitung total data
                  $total_query = "SELECT COUNT(*) FROM disposisi";
                  $total_result = mysqli_query($konek, $total_query);
                  $total_rows = mysqli_fetch_array($total_result)[0];
                  $total_pages = ceil($total_rows / $limit);
                  ?>

                  <!-- Pagination -->
                  <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <!-- Tombol Previous -->
                      <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= ($page > 1) ? $page - 1 : 1; ?>">Previous</a>
                      </li>

                      <!-- Nomor Halaman -->
                      <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                          <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                      <?php endfor; ?>

                      <!-- Tombol Next -->
                      <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= ($page < $total_pages) ? $page + 1 : $total_pages; ?>">Next</a>
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

<div id="myDispo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <font><b>Disposisikan Surat</b></font>
        </center>
      </div>
      <div class="modal-body">
        <form method="POST" action="" enctype="multipart/form-data">
          <div class="form-group">
            <?php
            //kode otomatis
            $dispo = $konek->query("select max(no_disposisi) as maxDis from disposisi");
            $datadis  = mysqli_fetch_array($dispo);
            $noSur4 = $datadis['maxDis'];

            $noUrut4 = (int) substr($noSur4, 6, 6);
            $noUrut4++;

            $char4 = "DISPO";
            $newDISPO = $char4 . sprintf("%03s", $noUrut4);
            ?>
            <label>No Disposisi :</label>
            <input class="form-control" type="text" name="nodispo" value="<?php echo $newDISPO; ?>" readonly />
            <label>Pilih No Surat :</label>
            <select class="form-control" name="pisur">
              <?php
              $dispo = mysqli_query($konek, "select * from surat_masuk");
              while ($dispo1 = mysqli_fetch_array($dispo)) {

              ?>
                <option><?php echo $dispo1['2']; ?></option>
              <?php
              }
              ?>
            </select>
            <label>Tanggal Disposisi :</label>
            <input class="form-control" type="text" id="tanggal1" name="tgl_dispo" value="" />
            <label>Pengirim Disposisi :</label>
            <input class="form-control" type="text" name="pengirim" value="<?php echo $_SESSION['no_peg']; ?>" readonly />
            <label>Disposisikan Kepada :</label>
            <select class="form-control" name="peg">
              <?php
              $peg = mysqli_query($konek, "select * from pegawai");
              while ($peg1 = mysqli_fetch_array($peg)) {

              ?>
                <option><?php echo $peg1['no_peg']; ?></option>
              <?php
              }
              ?>
            </select>
            <label>Subject :</label>
            <input class="form-control" type="text" name="judul_dispo" placeholder="masukan subject" />
            <label>Catatan :</label>
            <textarea class="form-control" type="text" name="catatan_dispo" placeholder="masukan catatan disposisi"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary" name="dispo">Disposisikan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_POST['dispo'])) {
  $no_dispo = $_POST['nodispo'];
  $no_surat = $_POST['pisur'];
  $tanggal = $_POST['tgl_dispo'];
  $kepada = $_POST['peg'];
  $judul = $_POST['judul_dispo'];
  $catatan = $_POST['catatan_dispo'];
  $pengirim = $_POST['pengirim'];

  $disposisi = mysqli_query(
    $konek,
    "INSERT INTO disposisi(no_disposisi, no_sumas, tgl_dispo, penerima, judul, catatan, pengirim) VALUES('$no_dispo', '$no_surat', '$tanggal', '$kepada', '$judul', '$catatan', '$pengirim')"
  );

  if ($disposisi) {
    echo "<script>alert('Disposisi berhasil!')</script>";
    echo "<script>window.location.href='disposisi.php'</script>";
  } else {
    echo "<script>alert('Disposisi gagal!')</script>";
  }
}
?>
<?php require_once('../tpl/about.php'); ?>
<?php require_once('../tpl/footer.php'); ?>