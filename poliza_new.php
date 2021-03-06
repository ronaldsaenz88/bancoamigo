<?php


require_once "conexion.php";
require_once "conexion_queries.php";
$conex_bd = Conexion::conectar();

$datos_tipopersona = Crud_TipoPersona::listado($conex_bd);
$datos_tipopoliza = Crud_TipoPoliza::listado($conex_bd);
$datos_agencia = Crud_Agencia::listado($conex_bd);
$datos_usuario = Crud_Usuario::listado($conex_bd);

$usuario_creacion = "admin";
if(session_id()=="")
{
    session_start();
    $usuario_creacion = $_SESSION["login"];
}

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
        <link rel="stylesheet" href="assets/vendors/css/base/elisyam-1.5.min.css">
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
                                            <div class="title">Notifications (4)</div>
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
                                    <li>
                                        <a href="#">
                                            <div class="message-icon">
                                                <i class="la la-history"></i>
                                            </div>
                                            <div class="message-body">
                                                <div class="message-body-heading">
                                                    Server rebooted
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
                                    <li><a rel="nofollow" href="pages-login.html" class="dropdown-item logout text-center"><i class="ti-power-off"></i></a></li>
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
                            <li ><a href="#dropdown-db" aria-expanded="false" data-toggle="collapse"><i class="la la-columns"></i><span>Dashboard</span></a>
                                <ul id="dropdown-db" class="collapse list-unstyled  pt-0">
                                    <li><a  href="index.php">Dashboard Principal</a></li>
                                </ul>
                            </li>
                            <li class="active"><a href="#dropdown-app" aria-expanded="true" data-toggle="collapse"><i class="la la-file-text"></i><span>Pólizas</span></a>
                                <ul id="dropdown-app" class="collapse list-unstyled show pt-0">
                                    <li><a class="active" href="poliza_new.php">Crear nueva póliza</a></li>
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
	                                <h2 class="page-header-title">Formulario Póliza</h2>
	                                <div>
			                            <ul class="breadcrumb">
			                                <li class="breadcrumb-item"><a href="index.php"><i class="ti ti-home"></i></a></li>
			                                <li class="breadcrumb-item active">Póliza</li>
			                                <li class="breadcrumb-item"><a href="soporte_ticket_new.php">Soporte Técnico</a></li>
			                            </ul>
	                                </div>
	                            </div>
                            </div>
                        </div>
                        <!-- End Page Header -->
                        <div class="row flex-row">
                            <div class="col-xl-12">
                                <!-- Form -->
                                <div class="widget has-shadow">
                                    <div class="widget-header bordered no-actions d-flex align-items-center">
                                        <h4>Creación de nueva póliza</h4>
                                    </div>
                                    <div class="widget-body">
                                        <div class="row flex-row justify-content-center">
                                            <div class="col-xl-10">
                                                <div id="rootwizard">
                                                    <div class="step-container">
                                                        <div class="step-wizard">
                                                            <div class="progress">
                                                                <div class="progressbar"></div>
                                                            </div>
                                                            <ul>
                                                                <li>
                                                                    <a href="#tab1" data-toggle="tab">
                                                                        <span class="step">1</span>
                                                                        <span class="title">Paso 1</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#tab2" data-toggle="tab">
                                                                        <span class="step">2</span>
                                                                        <span class="title">Paso 2</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <form id="saveForm" action="poliza_save.php" method="POST" role="search">
                                                    <div class="tab-content">
                                                        <div class="tab-pane" id="tab1">
                                                            <div class="section-title mt-5 mb-5">
                                                                <h4>Información Persona</h4>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Nombres<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" name="persona_nombres" value="" class="form-control">
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Cédula<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" name="persona_cedula"  value="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-5">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Telefóno<span class="text-danger ml-2">*</span></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon addon-secondary">
                                                                            <i class="la la-phone"></i>
                                                                        </span>
                                                                        <input type="text" name="persona_telefono"  class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Tipo de Persona<span class="text-danger ml-2">*</span></label>
                                                                    <select name="persona_tipo" class="custom-select form-control">
                                                                        <option value="">Seleccionar</option>
                                                                        <?php
                                                                        foreach($datos_tipopersona as $row){
                                                                        ?>
                                                                        <option value="<?php echo $row['id']; ?>" <?php if($row['id']=='2'){echo "selected";} ?>><?php echo $row['nombre']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-5">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Lugar Nacimiento<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" name="persona_lugar_nacimiento"  value="" class="form-control">
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Fecha Nacimiento<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" name="persona_fecha_nacimiento" class="form-control" placeholder="YYYY-MM-DD">
                                                                </div>
                                                            </div>
                                                            <div class="section-title mt-5 mb-5">
                                                                <h4>Domicilio</h4>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Dirección<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" name="persona_direccion"  value="" class="form-control">
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Ciudad<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" name="persona_direccion_ciudad"  value="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <ul class="pager wizard text-right">
                                                                <li class="next d-inline-block">
                                                                    <a href="javascript:;" class="btn btn-gradient-01">Siguiente</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" id="tab2">
                                                            <div class="section-title mt-5 mb-5">
                                                                <h4>Detalle Banco Amigo</h4>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Agencia<span class="text-danger ml-2">*</span></label>
                                                                    <select name="poliza_agencia" class="custom-select form-control">
                                                                        <option value="">Seleccionar</option>
                                                                        <?php
                                                                        foreach($datos_agencia as $row){
                                                                        ?>
                                                                        <option value="<?php echo $row['id']; ?>" <?php if($row['id']=='1'){echo "selected";} ?>><?php echo $row['nombre']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Usuario<span class="text-danger ml-2">*</span></label>
                                                                    <select name="poliza_usuario" class="custom-select form-control">
                                                                        <option value="">Seleccionar</option>
                                                                        <?php
                                                                        foreach($datos_usuario as $row){
                                                                        ?>
                                                                        <option value="<?php echo $row['login']; ?>" <?php if($row['login']==$usuario_creacion){echo "selected";} ?>><?php echo $row['nombres']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Tipo de Poliza<span class="text-danger ml-2">*</span></label>
                                                                    <select name="poliza_tipo" class="custom-select form-control">
                                                                        <option value="">Seleccionar</option>
                                                                        <?php
                                                                        foreach($datos_tipopoliza as $row){
                                                                        ?>
                                                                        <option value="<?php echo $row['id']; ?>" <?php if($row['id']=='1'){echo "selected";} ?>><?php echo $row['nombre']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="section-title mt-5 mb-5">
                                                                <h4>Información Póliza</h4>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Monto</label>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon addon-primary">$</span>
                                                                            <input type="text" name="poliza_monto" class="form-control">
                                                                            <span class="input-group-addon addon-orange">.00</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Fecha de Caducidad</label>
                                                                    <input type="text" name="poliza_fecha_caducidad" class="form-control" placeholder="YYYY-MM-DD">
                                                                </div>
                                                            </div>
                                                            <ul class="pager wizard text-right">
                                                                <li class="previous d-inline-block">
                                                                    <a href="javascript:;" class="btn btn-secondary ripple">Anterior</a>
                                                                </li>
                                                                <li class="next d-inline-block">
                                                                    <button type="submit" class="finish btn btn-lg btn-gradient-01" data-toggle="modal" data-target="#success-modal" name="guardar">Guardar</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <!-- Begin Modal -->
                                                    <div id="success-modal" class="modal fade">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-body text-center">
                                                                    <div class="sa-icon sa-success animate" style="display: block;">
                                                                        <span class="sa-line sa-tip animateSuccessTip"></span>
                                                                        <span class="sa-line sa-long animateSuccessLong"></span>
                                                                        <div class="sa-placeholder"></div>
                                                                        <div class="sa-fix"></div>
                                                                    </div>
                                                                    <div class="section-title mt-5 mb-2">
                                                                        <h2 class="text-gradient-02">Gracias!</h2>
                                                                    </div>
                                                                    <p class="mb-5">La póliza fue ingresada exitosamente!!</p>
                                                                    <button type="submit" class="btn btn-shadow mb-3" data-dismiss="modal" name='ok'>Ok</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                  </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->
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
            </div>
            <!-- End Page Content -->
        </div>
        <!-- Begin Vendor Js -->
        <script src="assets/vendors/js/base/jquery.min.js"></script>
        <script src="assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="assets/vendors/js/nicescroll/nicescroll.min.js"></script>
        <script src="assets/vendors/js/bootstrap-wizard/bootstrap.wizard.min.js"></script>
        <script src="assets/vendors/js/app/app.min.js"></script>
        <!-- End Page Vendor Js -->
        <!-- Begin Page Snippets -->
        <script src="assets/js/components/wizard/form-wizard.min.js"></script>
        <!-- End Page Snippets -->
    </body>
</html>
