    <?php
    session_start();
    if (empty($_SESSION['username'])) {
      header("Location: ../index.php");
    }
    include '../assets/configuration/konek.php';

    if (isset($_POST['update'])) {
      $user = $_SESSION['no_peg'];
      $namapeg = $_POST['namapeg'];
      $jabatan = $_POST['jabatan'];
      $jns_kelamin = $_POST['jns_kelamin'];
      $username = $_POST['username'];
      $nip = $_POST['nip'];
      $alamat = $_POST['alamat'];
      $no_telp = $_POST['no_telp'];
      $golongan = $_POST['golongan'];
      $pertanyaan = $_POST['pertanyaan'];

      $pegawai = mysqli_query($konek, "SELECT * FROM pegawai WHERE no_peg='$user' LIMIT 1");
      $check = mysqli_fetch_array($pegawai);

      if (!empty($_FILES['photo']['name'])) {
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES['photo']['name']);

        if (!empty($check['photo']) && file_exists($check['photo'])) {
          unlink($check['photo']);
        }

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
          $updateImage = mysqli_query($konek, "UPDATE pegawai SET photo='$target_file' WHERE no_peg='$user'");
          $_SESSION['photo'] = $target_file;
        } else {
          echo "<script>alert('Gagal mengupload file!')</script>";
        }
      }

      // Update data di database
      $update = mysqli_query($konek, "UPDATE pegawai SET 
      nama_peg='$namapeg', 
      jabatan='$jabatan', 
      alamat='$alamat',
      username='$username',
      nip = '$nip',
      golongan = '$golongan',
      no_telp='$no_telp', 
      jns_kelamin='$jns_kelamin'
      WHERE no_peg='$user' ");

      if ($update) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Berhasil mengupdate data!')</script>";
        echo "<script>window.location.href='ubah.php'</script>";
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
            <div class="mt-3">
              <div class="row">
                <div class="col-md-3">
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline mb-3">
                    <div class="card-body box-profile">
                      <?php
                      $sel = $_SESSION['no_peg'];
                      $sel1 = mysqli_query($konek, "select * from pegawai where no_peg='$sel'");
                      $sel2 = mysqli_fetch_array($sel1);
                      ?>
                      <div class="text-center">
                        <?php
                        if ($sel2['photo']) {
                        ?>
                          <img
                            class="profile-user-img rounded-circle shadow-lg mb-2"
                            src="<?= $sel2['photo'] ?>"
                            width="150"
                            height="150"
                            alt="Photo <?= $sel2['username'] ?>" />
                        <?php
                        } else {
                          echo "<i class='bi bi-person' style='font-size: 105px;'></i>";
                        ?>
                        <?php } ?>
                      </div>
                      <h3 class="profile-username text-center"><?php echo $sel2['nama_peg']; ?></h3>

                      <p class="text-muted text-center"><?php echo $sel2['jabatan']; ?></p>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Kode Pegawai</b> <a class="float-right" style="text-decoration: none;"><?= $sel2['no_peg'] ?></a>
                        </li>
                        <li class="list-group-item">
                          <b>Level</b> <a class="float-right" style="text-decoration: none;"><?= ucfirst($sel2['level']) ?></a>
                        </li>
                        <li class="list-group-item">
                          <b>NIP</b> <a class="float-right" style="text-decoration: none;"><?= ucfirst($sel2['nip']) ?></a>
                        </li>
                      </ul>

                      <a href="logout.php" class="btn btn-primary btn-block"><b>Logout</b></a>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item">
                          <a
                            class="nav-link active"
                            href="#activity"
                            data-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#profil" data-toggle="tab">Ubah Profil</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#settings" data-toggle="tab">Ubah Password</a>
                        </li>
                      </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                          <div class="table-responsive">
                            <table class="table borderless">

                              <tr>
                                <th>Nama</th>
                                <td>: <?php echo $sel2['nama_peg']; ?></td>
                              </tr>
                              <tr>
                                <th>Username</th>
                                <td>: <?php echo $sel2['username']; ?></td>
                              </tr>
                              <tr>
                                <th>Nomor Induk Pegawai</th>
                                <td>: <?php echo $sel2['nip']; ?></td>
                              </tr>
                              <tr>
                                <th>Golongan</th>
                                <td>: <?php echo $sel2['golongan']; ?></td>
                              </tr>
                              <tr>
                                <th>Jabatan</th>
                                <td>: <?php echo $sel2['jabatan']; ?></td>
                              </tr>
                              <tr>
                                <th>Jenis Kelamin</th>
                                <td>: <?php echo $sel2['jns_kelamin']; ?></td>
                              </tr>
                              <tr>
                                <th>Alamat</th>
                                <td>: <?php echo $sel2['alamat']; ?></td>
                              </tr>
                              <tr>
                                <th>No Telepon</th>
                                <td>: <?php echo $sel2['no_telp']; ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="profil">
                          <form method="post" enctype="multipart/form-data" action="">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for=""> Photo </label>
                                  <input type="file" name="photo" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label for=""> Nama </label>
                                  <input type="text" class="form-control" name="namapeg" value="<?= $sel2['nama_peg'] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for=""> Jabatan </label>
                                  <input type="text" class="form-control" name="jabatan" value="<?= $sel2['jabatan'] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for=""> Jenis Kelamin </label>
                                  <select name="jns_kelamin" id="" class="form-control">
                                    <option <?php if ($sel2['jns_kelamin'] == 'laki-laki') {
                                              echo 'selected';
                                            } ?> value="laki-laki">Laki Laki</option>
                                    <option <?php if ($sel2['jns_kelamin'] == 'perempuan') {
                                              echo 'selected';
                                            } ?> value="perempuan">Perempuan</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for=""> Username </label>
                                  <input type="text" class="form-control" name="username" value="<?= $sel2['username'] ?>" autocomplete="off">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for=""> Nomor Induk Pegawai </label>
                                  <input type="text" class="form-control" name="nip" value="<?= $sel2['nip'] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for=""> Alamat </label>
                                  <input type="text" class="form-control" name="alamat" value="<?= $sel2['alamat'] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for=""> No telpon </label>
                                  <input type="text" class="form-control" name="no_telp" value="<?= $sel2['no_telp'] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for=""> Golongan </label>
                                  <input type="text" class="form-control" name="golongan" value="<?= $sel2['golongan'] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for=""> Pertanyaan </label>
                                  <input type="text" class="form-control" name="pertanyaan" value="<?= $sel2['pertanyaan'] ?>" autocomplete="off">
                                </div>
                                <div class="d-flex flex-row-reverse bd-highlight">
                                  <button name="update" class="btn btn-primary"> Update Profil </button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane" id="settings">
                          <form method="post" action="" class="form-horizontal">
                            <?php
                            if (isset($_POST['change'])) {
                              $user = $_SESSION['no_peg'];
                              $new = $_POST['ganti'];
                              $query = mysqli_query($konek, "update pegawai set password='$new' where no_peg='$user'");
                              if ($query == TRUE) {
                                echo "<script>alert('password berhasil diubah :)')</script>";
                                echo "<script>window.location.href='ubah.php'</script>";
                              } else {
                                echo "<script>alert('password gagal diubah :(')</script>";
                              }
                            }
                            ?>
                            <div class="form-group row">
                              <label
                                for="inputSkills"
                                class="col-sm-2 col-form-label">Password Baru</label>
                              <div class="col-sm-10">
                                <input
                                  name="ganti"
                                  type="password"
                                  class="form-control"
                                  placeholder="Password Baru" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <div class="checkbox">
                                  <label> <span class="text-danger text-sm">
                                      * Feature ini untuk merubah password pada akun anda, harap password diingat ingat atau ditulis pada secarik kertas agar tidak lupa
                                    </span>
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <button name="change" class="btn btn-danger">
                                  Ganti Password
                                </button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

    <?php require_once('../tpl/sumas.php'); ?>
    <?php require_once('../tpl/sukel.php'); ?>
    <?php require_once('../tpl/dispo.php'); ?>
    <?php require_once('../tpl/about.php'); ?>
    <?php require_once('../tpl/footer.php'); ?>