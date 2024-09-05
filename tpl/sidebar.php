<style>
    .logo {
        float: left;
        font-size: 20px;
        line-height: 50px;
        text-align: center;
        padding: 0 10px;
        width: 220px;
        font-family: 'Kaushan Script';
        font-weight: 500;
        height: 50px;
        display: block;
    }
</style>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="../manage/index.php" class="brand-link"> <!--begin::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light logo">PKLK | MailTrack</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="../manage/index.php" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                        <p> Dashboard
                        </p>
                    </a>
                </li>
                <?php 
                if($_SESSION['level'] == 'admin'){ ?>
                    <li class="nav-item">
                        <a href="pegawai.php" class="nav-link"> <i class="nav-icon bi bi-person"></i>
                            <p> Data Pegawai
                            </p>
                        </a>
                    </li>
                <?php
                    }
                ?>
                <li class="nav-item">
                    <a href="../manage/surat-keluar.php" class="nav-link"> <i class="nav-icon bi bi-envelope-arrow-up-fill"></i>
                        <p> Data Surat Keluar

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../manage/surat-masuk.php" class="nav-link"> <i class="nav-icon bi bi-envelope-arrow-down-fill"></i>
                        <p> Data Surat Masuk

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../manage/disposisi.php" class="nav-link"> <i class="nav-icon bi bi-arrow-left-right"></i>
                        <p> Disposisi Surat

                        </p>
                    </a>
                </li>
                <li class="nav-item" data-toggle="modal" data-target="#myAbout">
                    <a href="#" class="nav-link"> <i class="nav-icon bi bi-info"></i>
                        <p> About

                        </p>
                    </a>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->