    <?php
    session_start();
    if (empty($_SESSION['username'])) {
      header("Location: ../index.php");
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
                  <div class="card card-primary card-outline">
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
                            class="profile-user-img rounded-circle shadow-lg"
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
                          <b>No Pegawai</b> <a class="float-right" style="text-decoration: none;"><?= $sel2['no_peg'] ?></a>
                        </li>
                        <li class="list-group-item">
                          <b>Level</b> <a class="float-right" style="text-decoration: none;"><?= ucfirst($sel2['level']) ?></a>
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


                        <div class="tab-pane" id="settings">
                          <form method="post" action="" class="form-horizontal">
                            <?php
                            if (isset($_POST['change'])) {
                              $user = $_SESSION['no_peg'];
                              $new = $_POST['ganti'];
                              $query = mysqli_query($konek, "update pegawai set password='$new' where no_peg='$user'");
                              if ($query == TRUE) {
                                echo "<script>alert('password berhasil diubah :)')</script>";
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