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
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body class="bg-white">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="assets/img/banco-amigo-smaller.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid no-padding h-100">
            <div class="row flex-row h-100 bg-white">
                <!-- Begin Left Content -->
                <div class="col-xl-8 col-lg-6 col-md-5 no-padding">
                    <div class="elisyam-bg background-01">
                        <div class="elisyam-overlay overlay-01" ></div>
                        <div class="authentication-col-content mx-auto">
                            <h1 class="gradient-text-01">
                                <br/><br/><br/><br/>
                                Bienvenido a Banco Amigo!
                            </h1>
                            <span class="description">
                                La entidad financiera más segura del Ecuador!
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Left Content -->
                <!-- Begin Right Content -->
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto no-padding">
                    <!-- Begin Form -->
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="/">
                                <img src="assets/img/banco-amigo.png" alt="logo">
                            </a>
                        </div>
                        <h3>Acceso a Banco Amigo</h3>
  											<form method="post" action="logon.php">
                            <div class="group material-input">
    														<input type="text" name="usuario" id="usuario" value="" placeholder="Usuario" required />
              							    <span class="highlight"></span>
              							    <span class="bar"></span>
              							    <label>Usuario</label>
                            </div>
                            <div class="group material-input">
    														<input type="password" name="clave" id="clave" value="" placeholder="Clave" required />
              							    <span class="highlight"></span>
              							    <span class="bar"></span>
              							    <label>Clave</label>
                            </div>
                            <div class="row">
                                <div class="col text-left">
                                    <div class="styled-checkbox">
                                        <input type="checkbox" name="checkbox" id="remeber">
                                        <label for="remeber">Recuerdame</label>
                                    </div>
                                </div>
                                <div class="col text-right">
                                </div>
                            </div>
                            <div class="sign-btn text-center">
									              <input type="submit" value="Ingresar" class="btn btn-lg btn-gradient-01" />
                            </div>
                        </form>
                    </div>
                    <!-- End Form -->
                </div>
                <!-- End Right Content -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Container -->
        <!-- Begin Vendor Js -->
        <script src="assets/vendors/js/base/jquery.min.js"></script>
        <script src="assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="assets/vendors/js/app/app.min.js"></script>
        <!-- End Page Vendor Js -->
    </body>
</html>
