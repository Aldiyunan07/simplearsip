<?php
require_once '../assets/configuration/konek.php';

?>

<html>

<head>
    <title>PKLK | MailTrack</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/data/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/data/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/data/css/dataTables.jqueryui.min.css">
    <link href="../assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Start Navbar Links-->
            <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
                <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="<?= $_SESSION['photo'] ?>" class="rounded-circle me-2" width="30" height="30" alt=""> <span class="d-none d-md-inline"><?php echo ucfirst($_SESSION['username']); ?></span> </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                        <li class="user-body"> <!--begin::Row-->
                            <div class="row">
                                <div class="col-4 text-center"> <a class="btn btn-primary btn-sm" href="ubah.php">Profile</a> </div>
                                <div class="col-4 text-center"> <a class="btn btn-danger btn-sm" href="logout.php">Logout</a> </div>
                            </div> <!--end::Row-->
                        </li> <!--end::Menu Body--> <!--begin::Menu Footer-->
                    </ul>
                </li> <!--end::User Menu Dropdown-->
            </ul> <!--end::End Navbar Links-->
        </div> <!--end::Container-->
    </nav> <!--end::Header--> <!--begin::Sidebar-->