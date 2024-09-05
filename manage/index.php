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
                    <div class="row mt-3">
                        <div class="col-lg-12 col-6">
                            <div class="small-box" style="background-color: #3A7BD5;">
                                <div class="inner p-4">
                                    <h6 class="text-light">Selamat datang </h6>
                                    <h5 class="text-light"><?php echo strtoupper($_SESSION['username']) ?></h5>
                                    <h6 class="text-light mt-5">PKLK | MailTrack</h6>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($_SESSION['level'] == "admin") {
                        ?>
                            <div class="col-lg-3 col-6">
                                <div class="small-box text-bg-primary">
                                    <div class="inner">
                                        <h3><?php
                                            $pegawai = mysqli_query($konek, "select * from pegawai"); {
                                            ?>
                                            <?php
                                                echo mysqli_num_rows($pegawai);
                                            }
                                            ?></h3>
                                        <p>Pegawai</p>
                                    </div> <i class="small-box-icon bi bi-person"></i>
                                    <a href="pegawai.php" style="text-decoration: none;" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                        More info <i class="fa fa-arrow-circle-right"></i> </a>
                                </div> <!--end::Small Box Widget 1-->
                            </div> <!--end::Col-->
                        <?php
                        }
                        ?>
                        <?php
                        if ($_SESSION['level'] == "admin") {
                            echo "<div class='col-lg-3 col-6'>";
                        } else {
                            echo "<div class='col-lg-4 col-6'>";
                        }
                        ?>
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3><?php
                                    $penerima = $_SESSION['no_peg'];
                                    $dis = mysqli_query($konek, "select * from disposisi where penerima='$penerima'"); {
                                    ?>
                                    <?php
                                        echo mysqli_num_rows($dis);
                                    }
                                    ?>
                                </h3>
                                <p>Disposisi</p>
                            </div> <i class="small-box-icon bi bi-arrow-left-right"></i> <a href="disposisi.php" style="text-decoration: none;" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div> <!--end::Small Box Widget 1-->
                    </div> <!--end::Col-->

                    <?php
                    if ($_SESSION['level'] == "admin") {
                        echo "<div class='col-lg-3 col-6'>";
                    } else {
                        echo "<div class='col-lg-4 col-6'>";
                    }
                    ?>
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3><?php
                                $tampilkan = mysqli_query($konek, "select * from surat_masuk"); {
                                ?>
                                <?php
                                    echo mysqli_num_rows($tampilkan);
                                }
                                ?>
                            </h3>
                            <p>Surat Masuk</p>
                        </div> <i class="small-box-icon bi bi-envelope-arrow-down-fill"></i> <a href="surat-masuk.php" style="text-decoration: none;" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div> <!--end::Small Box Widget 1-->
                </div> <!--end::Col-->

                <?php
                if ($_SESSION['level'] == "admin") {
                    echo "<div class='col-lg-3 col-6'>";
                } else {
                    echo "<div class='col-lg-4 col-6'>";
                }
                ?>
                <div class="small-box text-light bg-warning">
                    <div class="inner">
                        <h3><?php
                            $keluar = mysqli_query($konek, "select * from surat_keluar"); {
                            ?>
                            <?php
                                echo mysqli_num_rows($keluar);
                            }
                            ?>
                        </h3>
                        <p>Surat Keluar</p>
                    </div> <i class="small-box-icon bi bi-envelope-arrow-up-fill"></i><a href="surat-keluar.php" style="text-decoration: none;" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="fa fa-arrow-circle-right"></i></a>
                </div> <!--end::Small Box Widget 1-->
            </div> <!--end::Col-->
    </div><!-- /.row -->
    </div>
    </div>
    </main>
    </div>

    <?php require_once('../tpl/sumas.php'); ?>
    <?php require_once('../tpl/sukel.php'); ?>
    <?php require_once('../tpl/dispo.php'); ?>
    <?php require_once('../tpl/about.php'); ?>
    <?php require_once('../tpl/footer.php'); ?>