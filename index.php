<?php
session_start();
if(session_id()=="" or !isset($_SESSION['time']))
{
  $newURL = '/login.php';
  header('Location: '.$newURL);
}

require_once "conexion.php";
require_once "conexion_queries.php";
$conex_bd = Conexion::conectar();

$datos_poliza = Crud_Poliza::listado_vista($conex_bd);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Banco Amigo</title>
        <meta name="description" content="Banco Amigo">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="assets/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendors/css/base/elisyam-1.5.css">
        <link rel="stylesheet" href="assets/css/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/owl-carousel/owl.theme.min.css">
        <link rel="stylesheet" href="assets/css/datatables/datatables.min.css">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body id="page-top">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="assets/img/banco-amigo-smaller.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>
            </div>
        </div>
        <!-- End Preloader -->
        <div class="page">
            <!-- Begin Header -->
            <header class="header">
                <nav class="navbar fixed-top">
                    <!-- Begin Search Box-->
                    <div class="search-box">
                        <button class="dismiss"><i class="ion-close-round"></i></button>
                        <form id="searchForm" action="#" role="search">
                            <input type="search" placeholder="Buscar ..." class="form-control">
                        </form>
                    </div>
                    <!-- End Search Box-->
                    <!-- Begin Topbar -->
                    <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
                        <!-- Begin Logo -->
                        <div class="navbar-header">
                            <a href="/" class="navbar-brand">
                                <div class="brand-image brand-big">
                                    <img src="assets/img/banco-amigo.png" alt="logo" class="logo-big">
                                </div>
                                <div class="brand-image brand-small">
                                    <img src="assets/img/banco-amigo-smaller.png" alt="logo" class="logo-small">
                                </div>
                            </a>
                            <!-- Toggle Button -->
                            <a id="toggle-btn" href="#" class="menu-btn active">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                            <!-- End Toggle -->
                        </div>
                        <!-- End Logo -->
                        <!-- Begin Navbar Menu -->
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                            <!-- Search -->
                            <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="la la-search"></i></a></li>
                            <!-- End Search -->
                            <!-- Begin Notifications -->
                            <li class="nav-item dropdown"><a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="la la-bell animated infinite swing"></i><span class="badge-pulse"></span></a>
                                <ul aria-labelledby="notifications" class="dropdown-menu notification">
                                    <li>
                                        <div class="notifications-header">
                                            <div class="title">Notificaciones</div>
                                            <div class="notifications-overlay"></div>
                                            <img src="assets/img/notifications/01.jpg" alt="..." class="img-fluid">
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="message-icon">
                                                <i class="la la-user"></i>
                                            </div>
                                            <div class="message-body">
                                                <div class="message-body-heading">
                                                    New user registered
                                                </div>
                                                <span class="date">2 hours ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="message-icon">
                                                <i class="la la-calendar-check-o"></i>
                                            </div>
                                            <div class="message-body">
                                                <div class="message-body-heading">
                                                    New event added
                                                </div>
                                                <span class="date">7 hours ago</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End Notifications -->
                            <!-- User -->
                            <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><img src="assets/img/avatar/avatar-01.jpg" alt="..." class="avatar rounded-circle"></a>
                                <ul aria-labelledby="user" class="user-size dropdown-menu">
                                    <li class="welcome">
                                        <a href="#" class="edit-profil"><i class="la la-gear"></i></a>
                                        <img src="assets/img/avatar/avatar-01.jpg" alt="..." class="rounded-circle">
                                    </li>
                                    <li>
                                        <a href="pages-profile.html" class="dropdown-item">
                                            Profile
                                        </a>
                                    </li>
                                    <li><a rel="nofollow" href="logoff.php" class="dropdown-item logout text-center"><i class="ti-power-off"></i></a></li>
                                </ul>
                            </li>
                            <!-- End User -->
                        </ul>
                        <!-- End Navbar Menu -->
                    </div>
                    <!-- End Topbar -->
                </nav>
            </header>
            <!-- End Header -->
            <!-- Begin Page Content -->
            <div class="page-content d-flex align-items-stretch">
                <div class="default-sidebar">
                    <!-- Begin Side Navbar -->
                    <nav class="side-navbar box-scroll sidebar-scroll">
                        <!-- Begin Main Navigation -->
                        <ul class="list-unstyled">
                            <li class="active"><a href="#dropdown-db" aria-expanded="true" data-toggle="collapse"><i class="la la-columns"></i><span>Dashboard</span></a>
                                <ul id="dropdown-db" class="collapse list-unstyled show pt-0">
                                    <li><a class="active" href="index.php">Dashboard Principal</a></li>
                                </ul>
                            </li>
                            <li><a href="#dropdown-app" aria-expanded="false" data-toggle="collapse"><i class="la la-file-text"></i><span>Pólizas</span></a>
                                <ul id="dropdown-app" class="collapse list-unstyled pt-0">
                                    <li><a href="poliza_new.php">Crear nueva póliza</a></li>
                                </ul>
                            </li>
                            <li><a href="#dropdown-support" aria-expanded="false" data-toggle="collapse"><i class="la la-support"></i><span>Soporte Técnico</span></a>
                                <ul id="dropdown-support" class="collapse list-unstyled pt-0">
                                    <li><a href="soporte_ticket_new.php">Crear nuevo ticket soporte</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- End Main Navigation -->
                    </nav>
                    <!-- End Side Navbar -->
                </div>
                <!-- End Left Sidebar -->
                <div class="content-inner">
                    <div class="container-fluid">
                        <!-- Begin Page Header-->
                        <div class="row">
                            <div class="page-header">
	                            <div class="d-flex align-items-center">
	                                <h2 class="page-header-title">Dashboard</h2>
	                                <div>
	                                <div class="page-header-tools">
	                                    <a class="btn btn-gradient-01" href="poliza_new.php">Agregar Póliza</a>
	                                </div>
	                                </div>
	                            </div>
                            </div>
                        </div>
                        <!-- End Page Header -->

                        <div class="row">
                            <div class="col-xl-12">
                                <!-- Pólizas -->
                                <div class="widget has-shadow">
                                    <div class="widget-header bordered no-actions d-flex align-items-center">
                                        <h4>Pólizas</h4>
                                    </div>
                                    <div class="widget-body">
                                        <div class="table-responsive">
                                            <table id="sorting-table" class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Id Póliza</th>
                                                        <th>Nombres</th>
                                                        <th>Cedula</th>
                                                        <th>Agencia</th>
                                                        <th>Fecha Emisión</th>
                                                        <th>Fecha Aprobación</th>
                                                        <th>Fecha Cadudicad</th>
                                                        <th><span style="width:100px;">Estado</span></th>
                                                        <th>Monto</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                  foreach($datos_poliza as $row){
                                                    $style_estado = 'info';
                                                    if($row['estado'] == "PENDIENTE"){ $style_estado = 'info'; }
                                                    if($row['estado'] == "CADUCADA"){ $style_estado = 'danger'; }
                                                    if($row['estado'] == "ACTIVO"){ $style_estado = 'success'; }
                                                  ?>
                                                    <tr>
                                                      <td><span class="text-primary"><?php echo $row['id_poliza']; ?></span></td>
                                                      <td><?php echo $row['nombres']; ?></td>
                                                      <td><?php echo $row['cedula']; ?></td>
                                                      <td><?php echo $row['agencia']; ?></td>
                                                      <td><?php echo $row['fecha_emision']; ?></td>
                                                      <td><?php echo $row['fecha_aprobacion']; ?></td>
                                                      <td><?php echo $row['fecha_caducidad']; ?></td>
                                                      <td><span style="width:100px;"><span class="badge-text badge-text-small <?php echo $style_estado; ?>"><?php echo $row['estado']; ?></span></span></td>
                                                      <td>$<?php echo $row['monto']; ?></td>
                                                      <td class="td-actions">
                                                          <a href="poliza_aprobar.php?id_poliza=<?php echo $row['id_poliza']; ?>"><i class="la la-check-square edit"></i></a>
                                                      </td>
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Sorting -->
                            </div>
                        </div>
                        <!-- End Row -->




                        <div class="row flex-row">
                            <div class="col-xl-7 col-md-6">
                                <!-- Begin Widget 10 -->
                                <div class="widget widget-10 has-shadow">
                                    <!-- Begin Widget Header -->
                                    <div class="widget-header bordered d-flex align-items-center">
                                        <h2>Support Tickets</h2>
                                        <div class="widget-options">
                                            <div class="dropdown">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                                    <i class="la la-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="la la-bell-slash"></i>Disable Alerts
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="la la-edit"></i>Edit Widget
                                                    </a>
                                                    <a href="#" class="dropdown-item faq">
                                                        <i class="la la-question-circle"></i>FAQ
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Widget Header -->
                                    <!-- Begin Widget Body -->
                                    <div class="widget-body no-padding">
                                        <ul class="ticket list-group w-100">
                                            <!-- 01 -->
                                            <li class="list-group-item">
                                                <div class="media">
                                                    <div class="media-left align-self-center pr-4">
                                                        <img src="assets/img/avatar/avatar-02.jpg" class="user-img rounded-circle" alt="...">
                                                    </div>
                                                    <div class="media-body align-self-center">
                                                        <div class="username">
                                                            <h4>Brandon Smith</h4>
                                                        </div>
                                                        <div class="msg">
                                                            <p>
                                                                Hello, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et mauris sapien sem, ornare id mauris vitae, ultricies volutpat ...
                                                            </p>
                                                        </div>
                                                        <div class="status"><span class="open mr-2">Open</span>(1 hour ago)</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End 01 -->
                                            <!-- 02 -->
                                            <li class="list-group-item">
                                                <div class="media">
                                                    <div class="media-left align-self-center pr-4">
                                                        <img src="assets/img/avatar/avatar-04.jpg" class="user-img rounded-circle" alt="...">
                                                    </div>
                                                    <div class="media-body align-self-center">
                                                        <div class="username">
                                                            <h4>Nathan Hunter</h4>
                                                        </div>
                                                        <div class="msg">
                                                            <p>
                                                                Hello, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et mauris sapien sem, ornare id mauris vitae, ultricies volutpat ...
                                                            </p>
                                                        </div>
                                                        <div class="status"><span class="pending mr-2">Pending</span>(2 hours ago)</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End 02 -->
                                            <!-- 03 -->
                                            <li class="list-group-item">
                                                <div class="media">
                                                    <div class="media-left align-self-center pr-4">
                                                        <img src="assets/img/avatar/avatar-05.jpg" class="user-img rounded-circle" alt="...">
                                                    </div>
                                                    <div class="media-body align-self-center">
                                                        <div class="username">
                                                            <h4>Megan Duncan</h4>
                                                        </div>
                                                        <div class="msg">
                                                            <p>
                                                                Hello, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et mauris sapien sem, ornare id mauris vitae, ultricies volutpat ...
                                                            </p>
                                                        </div>
                                                        <div class="status"><span class="closed mr-2">Closed</span>(1 day ago)</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End 03 -->
                                        </ul>
                                    </div>
                                    <!-- End Widget Body -->
                                </div>
                                <!-- End Widget 10 -->
                            </div>
                            <div class="col-xl-5">
                                <!-- Begin Widget 11 -->
                                <div class="widget widget-11 has-shadow">
                                    <!-- Begin Widget Header -->
                                    <div class="widget-header bordered d-flex align-items-center">
                                        <h2>Activity Log</h2>
                                        <div class="widget-options">
                                            <div class="dropdown">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                                    <i class="la la-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="la la-history"></i>History
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="la la-bell-slash"></i>Disable Alerts
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="la la-edit"></i>Edit Widget
                                                    </a>
                                                    <a href="#" class="dropdown-item faq">
                                                        <i class="la la-question-circle"></i>FAQ
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Widget Header -->
                                    <!-- Begin Widget Body -->
                                    <div class="widget-body p-0 widget-scroll" style="max-height:450px;">
                                    <!-- Begin 01 -->
                                    <div class="timeline violet">
                                        <div class="timeline-content d-flex align-items-center">
                                            <div class="user-image">
                                                <img class="rounded-circle" src="assets/img/avatar/avatar-06.jpg" alt="...">
                                            </div>
                                            <div class="d-flex flex-column mr-auto">
                                                <div class="title">
                                                    <span class="username">Beverly Oliver</span>
                                                    Send you a friend request
                                                </div>
                                                <div class="time">4 min ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 01 -->
                                    <!-- Begin 02 -->
                                    <div class="timeline red">
                                        <div class="timeline-content d-flex align-items-center">
                                            <div class="timeline-icon">
                                                <i class="la la-spinner"></i>
                                            </div>
                                            <div class="d-flex flex-column mr-auto">
                                                <div class="title">
                                                    Server rebooted
                                                </div>
                                                <div class="time">10 min ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 02 -->
                                    <!-- Begin 03 -->
                                    <div class="timeline violet">
                                        <div class="timeline-content d-flex align-items-center">
                                            <div class="user-image">
                                                <img class="rounded-circle" src="assets/img/avatar/avatar-05.jpg" alt="...">
                                            </div>
                                            <div class="d-flex flex-column mr-auto">
                                                <div class="title">
                                                    <span class="username">Megan Duncan</span>
                                                    Followed 4 people
                                                    <div class="users-like">
                                                        <a href="profile.html">
                                                            <img src="assets/img/avatar/avatar-01.jpg" class="img-fluid rounded-circle" alt="...">
                                                        </a>
                                                        <a href="profile.html">
                                                            <img src="assets/img/avatar/avatar-02.jpg" class="img-fluid rounded-circle" alt="...">
                                                        </a>
                                                        <a href="profile.html">
                                                            <img src="assets/img/avatar/avatar-07.jpg" class="img-fluid rounded-circle" alt="...">
                                                        </a>
                                                        <a href="profile.html">
                                                            <img src="assets/img/avatar/avatar-09.jpg" class="img-fluid rounded-circle" alt="...">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="time">12 min ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 03 -->
                                    <!-- Begin 04 -->
                                    <div class="timeline blue">
                                        <div class="timeline-content d-flex align-items-center">
                                            <div class="timeline-icon">
                                                <i class="la la-heart-o"></i>
                                            </div>
                                            <div class="d-flex flex-column mr-auto">
                                                <div class="title">
                                                    <span class="username">Brandon Smith</span>
                                                    Liked <span class="font-weight-bold"><a href="#">Elisyam Admin Template</a></span>
                                                </div>
                                                <div class="time">30 min ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 04 -->
                                    <!-- Begin 05 -->
                                    <div class="timeline violet">
                                        <div class="timeline-content d-flex align-items-center">
                                            <div class="timeline-icon">
                                                <i class="la la-twitter"></i>
                                            </div>
                                            <div class="d-flex flex-column mr-auto">
                                                <div class="title">
                                                    + 3 new followers
                                                    <div class="users-like">
                                                        <a href="profile.html">
                                                            <img src="assets/img/avatar/avatar-09.jpg" class="img-fluid rounded-circle" alt="...">
                                                        </a>
                                                        <a href="profile.html">
                                                            <img src="assets/img/avatar/avatar-06.jpg" class="img-fluid rounded-circle" alt="...">
                                                        </a>
                                                        <a href="profile.html">
                                                            <img src="assets/img/avatar/avatar-03.jpg" class="img-fluid rounded-circle" alt="...">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="time">34 min ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 05 -->
                                    <!-- Begin 06 -->
                                    <div class="timeline violet">
                                        <div class="timeline-content d-flex align-items-center">
                                            <div class="user-image">
                                                <img class="rounded-circle" src="assets/img/avatar/avatar-04.jpg" alt="...">
                                            </div>
                                            <div class="d-flex flex-column mr-auto">
                                                <div class="title">
                                                    <span class="username">Nathan Hunter</span>
                                                    Invited you in a group
                                                </div>
                                                <div class="time">42 min ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 06 -->
                                    <!-- Begin 06 -->
                                    <div class="timeline violet">
                                        <div class="timeline-content d-flex align-items-center">
                                            <div class="user-image">
                                                <img class="rounded-circle" src="assets/img/avatar/avatar-03.jpg" alt="...">
                                            </div>
                                            <div class="d-flex flex-column mr-auto">
                                                <div class="title">
                                                    <span class="username">Louis Henry</span>
                                                    Is now following you
                                                </div>
                                                <div class="time">50 min ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 06 -->
                                    <!-- Begin 07 -->
                                    <div class="timeline blue">
                                        <div class="timeline-content d-flex align-items-center">
                                            <div class="timeline-icon">
                                                <i class="la la-image"></i>
                                            </div>
                                            <div class="d-flex flex-column mr-auto">
                                                <div class="title">
                                                    <span class="username">Brandon Smith</span>
                                                    Uploaded <span class="font-weight-bold"><a href="#">8 photos</a></span>
                                                </div>
                                                <div class="time">1 hour ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 07 -->
                                    </div>
                                    <!-- End Widget Body -->
                                </div>
                                <!-- End Widget 11 -->
                            </div>
                        </div>
                        <!-- End Row -->

                    </div>
                    <!-- End Container -->
                    <!-- Begin Page Footer-->
                    <footer class="main-footer">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-start justify-content-lg-start justify-content-md-start justify-content-center">
                                <p class="text-gradient-02">Design By Admin - Campeonato Nacional de Ciberseguridad del Ecuador</p>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-center">
                                <ul class="nav">
                                </ul>
                            </div>
                        </div>
                    </footer>
                    <!-- End Page Footer -->
                </div>
                <!-- End Content -->
            </div>
            <!-- End Page Content -->
        </div>
        <!-- Begin Success Modal -->
        <div id="delay-modal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="sa-icon sa-success animate" style="display: block;">
                            <span class="sa-line sa-tip animateSuccessTip"></span>
                            <span class="sa-line sa-long animateSuccessLong"></span>
                            <div class="sa-placeholder"></div>
                            <div class="sa-fix"></div>
                        </div>
                        <div class="section-title mt-5 mb-5">
                            <h2 class="text-dark">Meeting successfully created</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Success Modal -->
        <!-- Begin Modal -->
        <div id="modal-view-event" class="modal modal-top fade calendar-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title event-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="media">
                            <div class="media-left align-self-center mr-3">
                                <div class="event-icon"></div>
                            </div>
                            <div class="media-body align-self-center mt-3 mb-3">
                                <div class="event-body"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        <!-- Begin Vendor Js -->
        <script src="assets/vendors/js/base/jquery.min.js"></script>
        <script src="assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="assets/vendors/js/datatables/datatables.min.js"></script>
        <script src="assets/vendors/js/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/vendors/js/datatables/jszip.min.js"></script>
        <script src="assets/vendors/js/datatables/buttons.html5.min.js"></script>
        <script src="assets/vendors/js/datatables/pdfmake.min.js"></script>
        <script src="assets/vendors/js/datatables/vfs_fonts.js"></script>
        <script src="assets/vendors/js/datatables/buttons.print.min.js"></script>
        <script src="assets/vendors/js/nicescroll/nicescroll.min.js"></script>
        <script src="assets/vendors/js/chart/chart.min.js"></script>
        <script src="assets/vendors/js/progress/circle-progress.min.js"></script>
        <script src="assets/vendors/js/calendar/moment.min.js"></script>
        <script src="assets/vendors/js/calendar/fullcalendar.min.js"></script>
        <script src="assets/vendors/js/owl-carousel/owl.carousel.min.js"></script>
        <script src="assets/vendors/js/app/app.js"></script>
        <!-- End Page Vendor Js -->
        <!-- Begin Page Snippets -->
        <script src="assets/js/dashboard/index.js"></script>
        <!-- End Page Snippets -->
    </body>
</html>
